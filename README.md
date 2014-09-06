dsEventCalendar
================

Description
----
My first official package for Concrete 5 - Event Calendar.
It is simple add on to create calendar with events and display it on page as block.

I have created some templates - red, blue, green. You can create own theme - just edit CSS or (better) SCSS! Each template has compass project for styles (on branch dev).

At now I use this calendar script:
http://www.vissit.com/jquery-event-calendar-plugin-english-version

Maybe in future I create something own with new features.

How to use
----
First, go to dashboard and add calendar in "Add / edit calendar" . After that you can create new event in "Add / edit event" connected with new added calendar (choose from select).

If you did this, go to page and add new block called "Event Calendar" and select calendar.

If you want, you can change template in Custom Templates.


Version
----
1.0.1

Changelog
----
1.0.1
Fix: Call to undefined method Block::getProxyBlock()

1.0.0
Official release. Fix: Removed jquery.eventCalendar.js files from color templates blocks - they are unnecessary (override by default jquery.eventCalendar.js in block)

0.9 - PRB submission

0.1 - Initial development 

Languages
----
You can set any language. Just edit eventCalendar properties in template like that:
In English - default
```javascript
$("#eventCalendarInline<?php echo $rand; ?>").eventCalendar({
    jsonData: eventsInline,
    jsonDateFormat: 'human',
    showDescription: true
});
```
In Polish:
```javascript
$("#eventCalendarInline<?php echo $rand; ?>").eventCalendar({
    jsonData: eventsInline,
    jsonDateFormat: 'human',
    showDescription: true
    monthNames: [ "Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec","Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień" ],  
    dayNames: [ 'Poniedziałek','Wtorek','Środa','Czwartek', 'Piątek','Sobota','Niedziela' ],  
    dayNamesShort: [ 'Pn','Wt','Śr','Cz', 'Pt','Sb','Nd' ],  
    txt_noEvents: "Brak wydarzeń w tym czasie",  
    txt_SpecificEvents_prev: "",
    txt_SpecificEvents_after: "Wydarzenia:",
    txt_next: "Następny",
    txt_prev: "Poprzedni",
    txt_NextEvents: "Następne wydarzenie:",
    txt_GoToEventUrl: "Idź do wydarzenia",
    txt_Loading: "Wczytywanie..."
});
```

License
----
MIT

Future features
----
* validation forms in dashboard
* multiday events (probably version 2)
* manage events from calendar (probably version 3)