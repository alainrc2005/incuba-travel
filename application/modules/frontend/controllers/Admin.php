<?php

/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 7/5/2017
 * Time: 11:29 AM
 */
class Admin extends MX_Controller
{

    public function hotelCalendar($hotelid,$year) {
        $data['hotelName'] = $this->db->query("select Name from hotelses where Id=?",[$hotelid])->row()->Name;
        $rooms = $this->db->query("select * from roomses where HotelId=?",[$hotelid])->result();
        $data['rooms'] = [];
        foreach ($rooms as $room) {
            $result = $this->db->query("SELECT * FROM rooms_prices WHERE HotelId=? AND roomid=? and YEAR(FromDate)=? ORDER BY FromDate", [$hotelid, $room->Id,$year])->result();
            $data['rooms'][$room->Name] = $this->makeCalendar($result,$room->Name,$year);
        }
        $this->load->view('hotelCalendar', $data);
    }

    public function makeCalendar($dates,$room,$year) {
        $colors = ['#7cb5ec', '#90ed7d', '#f7a35c', '#91e8e1', '#618685', '#e4d354', '#87bdd8','#8d9db6'];
        $pos = 0;
        foreach ($dates as $date) {
            $date->color = $colors[$pos];
            if ($pos++ == count($colors)) $pos = 0;
        }
        $months = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $current_month = date('n');
        $current_year = $year;
        $current_day = date('d');
        $month = 0;

        $calendar = '<table class="calendar">';
        $calendar .= "<th colspan='4' class='year text-center'>$current_year - $room</th>";

        // Table of months
        for ($row = 1; $row <= 3; $row++) {
            $calendar .= '<tr>';
            for ($column = 1; $column <= 4; $column++) {
                $calendar .= '<td class="month">';

                $month++;

                $first_day_in_month = date('w', mktime(0, 0, 0, $month, 1, $current_year));
                $month_days = date('t', mktime(0, 0, 0, $month, 1, $current_year));

                // in PHP, Sunday is the first day in the week with number zero (0)
                // to make our calendar works we will change this to (7)
                if ($first_day_in_month == 0) {
                    $first_day_in_month = 7;
                }

                $calendar .= '<table>';
                $calendar .= '<th colspan="7">' . $months[$month - 1] . '</th>';
                $calendar .= '<tr class="days"><td style="width:30px">L</td><td style="width:30px">M</td><td style="width:30px">M</td><td style="width:30px">J</td><td style="width:30px">V</td>';
                $calendar .= '<td class="sat" style="width:30px">S</td><td class="sun" style="width:30px">D</td></tr>';
                $calendar .= '<tr>';

                for ($i = 1; $i < $first_day_in_month; $i++) {
                    $calendar .= '<td> </td>';
                }

                for ($day = 1; $day <= $month_days; $day++) {
                    $pos = ($day + $first_day_in_month - 1) % 7;
                    $class = (($day == $current_day) && ($month == $current_month)) ? 'today' : 'day';
                    $class .= ($pos == 6) ? ' sat' : '';
                    $class .= ($pos == 0) ? ' sun' : '';
                    $bgcolor = $this->inDay($dates, $day, $month, $year);


                    $calendar .= "<td class='$class' style='background-color: $bgcolor'>$day</td>";
                    if ($pos == 0) $calendar .= '</tr><tr>';
                }

                $calendar .= '</tr>';
                $calendar .= '</table>';

                $calendar .= '</td>';
            }
            $calendar .= '</tr>';
        }


        $calendar .= '</table>';
        $calendar .= '<br><br><table class="table table-bordered">';
        foreach ($dates as $date) {
            $calendar .= "<tr style='background-color: $date->color'><td>$date->FromDate</td><td>$date->ToDate</td><td>$date->Price</td><td>$date->Name</td></tr>";
        }
        $calendar .= '</table>';

        return $calendar;
    }

    function inDay($dates, $day, $month, $year) {
        $mdate = $year . '-' . ($month < 10 ? '0' . $month : $month) . '-' . ($day < 10 ? '0' . $day : $day);
        $result = [];
        foreach ($dates as $date) {
            if ($mdate >= $date->FromDate && $mdate <= $date->ToDate) $result[] = $date->color;
        }
        $count = count($result);
        if ($count===0) return '#F1F5F6';
        if ($count>1) return '#FF0000';
        return $result[0];
    }

    /* draws a calendar */
    function draw_calendar($month, $year) {

        /* draw table */
        $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

        /* table headings */
        $headings = array('D', 'L', 'M', 'M', 'J', 'V', 'S');
        $calendar .= '<tr class="calendar-row"><td class="calendar-day-head">' . implode('</td><td class="calendar-day-head">', $headings) . '</td></tr>';

        /* days and weeks vars now ... */
        $running_day = date('w', mktime(0, 0, 0, $month, 1, $year));
        $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
        $days_in_this_week = 1;
        $day_counter = 0;
        $dates_array = array();

        /* row for week one */
        $calendar .= '<tr class="calendar-row">';

        /* print "blank" days until the first of the current week */
        for ($x = 0; $x < $running_day; $x++):
            $calendar .= '<td class="calendar-day-np"> </td>';
            $days_in_this_week++;
        endfor;

        /* keep going with days.... */
        for ($list_day = 1; $list_day <= $days_in_month; $list_day++):
            $calendar .= '<td class="calendar-day">';
            /* add in the day number */
            $calendar .= '<div class="day-number">' . $list_day . '</div>';

            /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
            $calendar .= str_repeat('<p> </p>', 2);

            $calendar .= '</td>';
            if ($running_day == 6):
                $calendar .= '</tr>';
                if (($day_counter + 1) != $days_in_month):
                    $calendar .= '<tr class="calendar-row">';
                endif;
                $running_day = -1;
                $days_in_this_week = 0;
            endif;
            $days_in_this_week++;
            $running_day++;
            $day_counter++;
        endfor;

        /* finish the rest of the days in the week */
        if ($days_in_this_week < 8):
            for ($x = 1; $x <= (8 - $days_in_this_week); $x++):
                $calendar .= '<td class="calendar-day-np"> </td>';
            endfor;
        endif;

        /* final row */
        $calendar .= '</tr>';

        /* end the table */
        $calendar .= '</table>';

        /* all done, return result */
        return $calendar;
    }

}