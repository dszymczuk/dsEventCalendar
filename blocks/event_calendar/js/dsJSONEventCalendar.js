/**
 * Author: Damian Szymczuk
 * Website: http://dszymczuk.pl
 * Version: 1.0
 * GitHub: https://github.com/dszymczuk/JSONEventCalendar
 */


(function( $ ) {
    $.fn.JSONEventCalendar = function(events,options) {

        var settings = $.extend($.fn.JSONEventCalendar.settings, options );
        settings.startFrom = settings.startFrom%7;
        
        var initMoment = moment();
        initMoment.locale(settings.lang);
        
        var names = {
            monthNames: initMoment._locale._months,
            dayNames: initMoment._locale._weekdays,
            dayNamesShort: initMoment._locale._weekdaysShort,
            dayNamesMin: initMoment._locale._weekdaysMin
        };

        return this.each( function() {
            var that = $(this);
            var year = moment().get('year');
            var month = moment().get('month');

            that.html(_drawCalendar({
                formatTitle: settings.formatTitle,
                lang: settings.lang
                ,year: year
                ,month: month
            }));
            _refreshDayHeight(that);


            /*------------*\
               NEXT MONTH
            \*------------*/
            that.on('click','.ds-next-month',function(){
                if(month > 10)
                {
                    month = 0;
                    year++;
                }
                else
                    month++;

                that.html(_drawCalendar({
                    formatTitle: settings.formatTitle,
                    lang: settings.lang
                    ,year: year
                    ,month: month
                }));
                _refreshDayHeight(that);
            });


            /*------------*\
               PREV MONTH
            \*------------*/
            that.on('click','.ds-prev-month',function(){
                if(month < 1)
                {
                    month=11;
                    year--;
                }
                else
                    month--;

                that.html(_drawCalendar({
                    formatTitle: settings.formatTitle,
                    lang: settings.lang
                    ,year: year
                    ,month: month
                }));
                _refreshDayHeight(that);
            });


            /*-------------*\
               EVENT CLICK
            \*-------------*/
            that.on('click','.ds-event',function(){
                var elem = $(this);
                var id = elem[0].id;

                var event =  _.find(events, function(e) {
                    return e.id == id;
                });
                $(".ds-calendar").append(_drawModalEvent(event));
            });


            /*-------------*\
               CLOSE MODAL
            \*-------------*/
            that.on('click','.ds-event-modal .close-button',function(){
                $(".ds-event-modal").remove();
            });
            
        });





        /**
         * Refresh height of element to equal size
         *
         * @param element
         * @private
         */
        function _refreshDayHeight(element) {
            var maxHeight = 0;
            element.find('.ds-events').each(function(){
                var that = $(this);
                if(that.height() > maxHeight)
                    maxHeight = that.height();
            }).each(function(){
                var that = $(this);
                that.css('height',maxHeight + "px");
            });
        }


        function _drawCalendar(options) {
            var year, month;
            var mom = moment();
            if(options.hasOwnProperty('year'))
                year = options.year;
            else
                year = mom.get('year');

            if(options.hasOwnProperty('month'))
                month = options.month;
            else
                month = mom.get('month');


            mom.set('year',year);
            mom.set('month',month);
            mom.locale(settings.lang);

            var before = {
                month: month,
                year: year
            };
            before.month--;

            /*---------------------------*\
                CALCUALTE BEFORE MONTH
            \*---------------------------*/
            if(month < 0)
            {
                before.month=11;
                before.year--;
            }


            var calendar = '<div class="ds-calendar">';

            //header
            calendar += '<div class="ds-calendar-header-border">';
            calendar += '<div class="ds-calendar-header">';
            calendar += '<div class="ds-prev-month arrow"><span>&lt;</span></div>';
            calendar += '<div class="ds-title-month">'+mom.format(settings.formatTitle)+'</div>';
            calendar += '<div class="ds-next-month arrow"><span>&gt;</span></div>';
            calendar += '</div>';
            calendar += '</div>';

            // name of days
            calendar += '<div class="ds-title">';

            var offset = settings.startFrom;

            calendar += '<div class="ds-day ds-new-week">'+names.dayNames[offset]+'</div>';
            for(var i = 1 + offset ; i < 7 + offset ; i++)
                calendar += '<div class="ds-day">'+names.dayNames[i%7]+'</div>';
            
            calendar += '</div>';


            
            /*-----------*\
                MONTH -1
            \*-----------*/
            var daysBefore = monthDays(before.year,before.month);
            var calcBefore = _calcBefore(year,month) + 7 - offset +1;
            daysBefore = daysBefore - calcBefore+1;

            if(calcBefore >= 7)
                calcBefore = calcBefore - 7;

            for(var b = 0 ; b < calcBefore ; b++)
            {
                calendar += drawDay(daysBefore+b,'before');
            }


            /*-----------------*\
                CUREENT MONTH
            \*-----------------*/
            var currDaysInMonth = monthDays(year,month);
            for(var c = 1 ; c <= currDaysInMonth ; c++)
            {
                calendar += drawDay(c,'current',true);
            }


            /*------------*\
                MONTH +1
            \*------------*/
            var nextMonth = 0;
            var cA = _calcAfter(year,month);
            if(cA === offset)
                cA = 8;

            cA = offset - cA;

            if(cA >= -5 && cA < 0)
                cA = 7 + cA;

            for(var a = 0 ; a < cA ; a++)
            {
                nextMonth++;
                calendar += drawDay(nextMonth,'after');
            }


            //to have 6 rows in calendar
            //@todo to think
//            if(cA !== 2 && cA !== 0)
//            {
//                for(var a = 0 ; a < 7 ; a++)
//                {
//                    nextMonth++;
//                    calendar += drawDay(nextMonth,'extra-after');
//                }
//            }

            calendar += '';
            calendar += '';
            calendar += '';
            calendar += '';
            calendar += '';

            calendar += '</div>';
            return calendar;

            function drawDay(day,elementClass,drawEvents){
                drawEvents = typeof drawEvents !== 'undefined' ? drawEvents : false;
                
                if(typeof elementClass === 'undefined')
                    elementClass = '';
                var dD = '';
                dD += '<div class="ds-day '+elementClass+'">';
                dD += '<div class="ds-day-header">'+day+'</div>';
                dD += '<div class="ds-events">';

                if(drawEvents)
                {
                    var events = _getEvents(day,month,year);
                    for(var e = 0 ; e < events.length ; e++)
                    {
                        dD += '<div class="ds-event" id="'+events[e].id+'" style="background-color: '+events[e].color+'">'+events[e].title+'</div>';
                    }

                }

                dD += '</div>';
                dD += '</div>';
                return dD;
            }
            
            function _calcBefore(year,month){
                var f = firstDayPosition(year,month,0)-1;

                if(f < 0)
                    return 6;
                else
                    return f;
            }

            function _calcAfter(year,month){
                month++;
                return firstDayPosition(year,month,0);
            }
            
            function _getEvents(day,month,year){
                return _.filter(events, function (sE) {
                    return moment(new Date(year, month, day)) <= new Date(sE.date.replace(/-/g,"/"))
                        && new Date(sE.date.replace(/-/g,"/")) < moment(new Date(year, month, day)).add(1, 'd');
                });
            }

            function monthDays(year,month) {
                month++;
                var d = new Date(year,month, 0);
                return d.getDate();
            }

            function firstDayPosition(year,month,offset) {
                var mom = moment();
                mom.set('year',year);
                mom.set('month',month);
                mom.date(1);
                return mom.day()+offset;
            }
        }

        function _drawModalEvent(event){
            var eventDetails = "";
            eventDetails += '<div class="ds-event-modal">';
            eventDetails += '<div class="container">';

            if(typeof  event.color !== "undefined")
                eventDetails += '<div class="header" style="background-color: '+event.color+'">';
            else
                eventDetails += '<div class="header">';


            eventDetails += '<p class="title">'+event.title+'</p>';


            eventDetails += '</p>';
            eventDetails += '</div>';
            eventDetails += '<div class="content">';
            eventDetails += '<p class="date">'+moment(event.date).locale(settings.lang).format(settings.formatEvent);

            //if(typeof  event.type !== "undefined" && event.type !== null)
            //    eventDetails += ', <span>'+event.type+'</span>';

            

            eventDetails += '<p class="description">'+event.description+'</p>';

            if(typeof event.url !== "undefined")
            {
                eventDetails += '<p class="url">';
                eventDetails += '<a href="'+event.url+'">'+event.url+'</a>';
                eventDetails += '</p>';
            }


            eventDetails += '</div>';
            eventDetails += '<div class="footer">';
            eventDetails += '<div class="close-button">';
            eventDetails += settings.closeText;
            eventDetails += '</div>';
            eventDetails += '</div>';
            eventDetails += '</div>';
            eventDetails += '</div>';
            return eventDetails;
        }
    }
}( jQuery ));


$.fn.JSONEventCalendar.settings = {
    lang: "en",
    formatTitle: "MMMM YYYY",
    formatEvent: "DD MMMM YYYY",
    startFrom: 1,
    eventsInDay: 3,
    closeText: 'close',
    typeText: 'Type:'
};