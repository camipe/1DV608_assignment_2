<?php

namespace view;

class DateTimeView {


	public function show() {
        /*
        Set timestring to the following date format
        [Day of week], the [day of month numeric]th of
        [Month as text] [year 4 digits].
        The time is [Hour]:[minutes]:[Seconds].
        Example: "Monday, the 8th of July 2015, The time is 10:59:21"
         */
		$timeString = date('l, \t\h\e jS \of F Y,') . ' The time is ' . date('H:i:s');

		return '<p>' . $timeString . '</p>';
	}
}
