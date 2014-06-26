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


Version
----
0.9

Changelog
----
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