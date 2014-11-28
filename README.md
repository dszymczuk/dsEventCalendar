dsEventCalendar
================

Description
----
My first official package for Concrete 5 - Event Calendar.

It is simple add on to create calendar with events and display it on page as block.


How to use
----
First, go to dashboard and add calendar in "Add / edit calendar" . After that you can create new event in "Add / edit event" connected with new added calendar (choose from select).

If you did this, go to page and add new block called "Event Calendar" and select calendar.


Version
----
2.1.5

Changelog
----
2.1.5
Fix some bugs ; add more languages (C5 market - English, Greek, Swedish, Polish, Italian, Dutch, Russian, German)

2.1
OFFICIAL RELEASE
Remove border of calendar ; set font smaller ; add some languages

2.0.12
Fix issue: Calender doesn't show events with time: 00:00:00

2.0.11
Fix display events on FF and IE

2.0.0beta
Development for new version.

Version 2 is not compatible with previous version! Database structure has been changed.

New feature:
* settings - you can set language ; date format
* types - you can define type of event with color (it will display in calendar)
* new calendar view with modal windows with info about event

1.0.1
Fix: Call to undefined method Block::getProxyBlock()

1.0.0
Official release. Fix: Removed jquery.eventCalendar.js files from color templates blocks - they are unnecessary (override by default jquery.eventCalendar.js in block)

0.9 - PRB submission

0.1 - Initial development 

Languages
----
You can set any language using gettext.


License
----
dsEventCalendar - Creative Commons
jQuery Event Calendar Plugin - GPL v3

Future features
----
* validation forms in dashboard
* multiday events (probably version 2)
* manage events from calendar (probably version 3)
