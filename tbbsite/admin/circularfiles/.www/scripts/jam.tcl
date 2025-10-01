bind pub - .time pub:time
bind pub - !time pub:time
bind pub - .jam pub:time
bind pub - !jam pub:time
proc pub:time { nick uhost hand chan text } {
 set waktu [ctime [unixtime]]
 set hari [lindex $waktu 0]
 set tanggal [lindex $waktu 2]
 set bulan [lindex $waktu 1]
 set tahun [lindex $waktu 4]
 set jam [lindex $waktu 3]
 if {$hari == "Mon"} { set hari "Senin" }
 if {$hari == "Tue"} { set hari "Selasa" }
 if {$hari == "Wed"} { set hari "Rabu" }
 if {$hari == "Thu"} { set hari "Kamis" }
 if {$hari == "Fri"} { set hari "Jum'at" }
 if {$hari == "Sat"} { set hari "Sabtu" }
 if {$hari == "Sun"} { set hari "Minggu" }
 if {$bulan == "Jan"} { set bulan "Januari" }
 if {$bulan == "Feb"} { set bulan "Februari" }
 if {$bulan == "Mar"} { set bulan "Maret" }
 if {$bulan == "Apr"} { set bulan "April" }
 if {$bulan == "May"} { set bulan "Mei" }
 if {$bulan == "Jun"} { set bulan "Juni" }
 if {$bulan == "Jul"} { set bulan "Juli" }
 if {$bulan == "Aug"} { set bulan "Agustus" }
 if {$bulan == "Sep"} { set bulan "September" }
 if {$bulan == "Oct"} { set bulan "Oktober" }
 if {$bulan == "Nov"} { set bulan "November" }
 if {$bulan == "Dec"} { set bulan "Desember" }
 if {[onchan $nick $chan]} {
  putquick "PRIVMSG $chan :$nick : $hari - $tanggal $bulan $tahun - $jam"
 }
}


#set timezone "GMT"
#set offset "+8"
#set env(TZ) "$timezone $offset"

