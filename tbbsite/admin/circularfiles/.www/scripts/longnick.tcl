############################################
## longnick.TcL v1.0 Modified By DurjanAv ##
## © Oct 2011, Bombat Community		##
## #GembelZ@allnetwork.org 		       ##
############################################

namespace eval longnick {
	
	foreach p [array names longnick *] { catch {unset longnick ($p) } }
	proc ::longnick::numgrp {number} { switch -glob -- "$number" { *11 {return 3} *12 {return 3} *13 {return 3} *14 {return 3} *1 {return 1} *2 {return 2} *3 {return 2} *4 {return 2} default {return 3} } }
	
	# Setting max panjang nick
	variable longnick 15
	
	# lama waktu ban
	variable bantime 5
	
	# Pesan ban
	variable reason "Ini nick panjang somo beken kereta api??? $longnick [lindex {. oke} [numgrp $longnick]]!"
	
	variable flags "-|f"
	
	# command --> .chanset #chan +longnick
	setudef flag longnick
	
	variable autors "DurjanA"
	variable version "1.0"
	variable date "24-10-2011"
	
	bind nick -|- "*?" ::longnick::nick
	bind join -|- "*?" ::longnick::join
	
	proc ::longnick::nick { nick host hand chan newnick } {
		main $newnick $chan $host $hand
	}
	
	proc ::longnick::join { nick host hand chan } {
		main $nick $chan $host $hand
	}
	
	proc ::longnick::main { nick chan host hand } {
	
		if { ![channel get $chan longnick] } { return }
		
		variable longnick
		variable bantime
		variable reason
		variable flags
		
		if { [llength [split $nick ""]] > $longnick } { 
		
		set mask "$nick!*@*"
		
			if { [matchattr $hand $flags $chan] } { return }
			
			newchanban $chan $mask $::botnick $reason $bantime
			putserv "mode $chan +b $mask"
			putserv "kick $chan $nick :$reason"
			
		}
	}
	
	putlog "longnick.tcl v$version by $autors -Loaded-"
}