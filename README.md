dsEventCalendar
================

[![Code Climate](https://codeclimate.com/github/dszymczuk/dsEventCalendar/badges/gpa.svg)](https://codeclimate.com/github/dszymczuk/dsEventCalendar)

Description
----
My first official package for Concrete 5 - Event Calendar.

It is simple add on to create calendar with events and display it on page as block.


How to use
----
First, go to dashboard and add calendar in "Add / edit calendar" . After that you can create new event in "Add / edit event" connected with new added calendar (choose from select).

If you did this, go to page and add new block called "Event Calendar" and select calendar.

After add event go to Calendar list -> show events for calendar. At now, you can manage events.
Drag and drop to change date.
Click for edit details.
If you choose "All day" event you can resize event for more days.
If you choose "One day with time" event you can resize event for more days.


Version
----
3.3.5

Changelog
----
3.3.5
Bug fixes - wrong date on modal ; twice open modal when click on list (PRO)
Possibility to change events from ALL calendars on calendar view

3.3.4
Add content height (calendar height) as option for block

3.3.3
Add ICS calendar ; To call calendar use link:
http://DOMAIN/index.php/tools/packages/dsEventCalendar/event_calendar/ical.php?id=1
where id is calendar ID (check on list of calendars).

3.3.2
Add scroll options for date / time picker in dashboard

3.3.1
Remove events from calendar

3.3
Filter calendar events by single type

3.2
Support language each block of calendar

3.1.7
Bug fixes with end date or time ; add minimal date or time in datepicker

3.1.6
Bug fix with opening modal while edit event

3.1.5
Add licenses to JS scripts ; fix bug with button on colorpicker

3.1.3
Fix display flex ; change add date function to compatible with PHP 5.2

3.1.2
IE8 fix ; You don't have to create backup with settings improvment

3.1
IMPORTANT !
Before update, please! make backup of database - I have to improve settings in database (remove duplicate data).

Change:
* start and end date/time
* time in modal
* time format
* add menu in dashboard to better navigation
* bug fixes


3.0.2
Join all JS scripts in block

3.0.1
Add translation

3.0.0
NEW VERSION - OFFICIAL RELEASE
Calendar based on http://fullcalendar.io/
Features:
* multiview in calendar (month, day, week)
* multiday events
* start and end time for event
* easier managment for events
* pretty modal

2.1.6
Some bug fixes

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
__Version 3__
* validation forms in dashboard
* multiday events
* replace jQuery plugin

__Planed__
* manage events from calendar
