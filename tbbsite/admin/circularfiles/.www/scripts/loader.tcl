bind msg n !load proc_load_msg

proc proc_load_msg {nick uhost hand rest} {
global notc own basechan owner

if {![matchattr $nick Q]} {
	putserv "PRIVMSG $nick :$notc Sorry $nick aaaaa... hanya Owner Yg Bisa pake PerinTah !load"
	putserv "PRIVMSG $nick :$notc Sory wuaa.... xixixixi.. \:p"
	return 0 
	}

if { $rest == ""} then {
	putserv "PRIVMSG $nick :$notc 4B1uaT 4A1naK"
	putserv "PRIVMSG $nick :$notc Penggunaan : \!load \[nick\] \[ident\] \[IP\] \[channel\] \[owner\]"
	return 0
	}

set nicknya [lindex $rest 0]
set identnya [lindex $rest 1]
set ipnya [lindex $rest 2]
set channya [lindex $rest 3]
set ownernya [lindex $rest 4]

if {$channya == ""} then { 
	putserv "PRIVMSG $nick :$notc 4B1uaT 4A1naK"
	putserv "PRIVMSG $nick :$notc Penggunaan : channelnya mana bos..?]"
	return 0
	}

catch { [exec ./ra $nicknya $identnya $ipnya $channya $ownernya] } result1

if {[string match "*ra*" $result1]} {
	puthlp "PRIVMSG $nick :$notc Ok, config file $nicknya BERHASIL dibuat"
	} else {
	puthlp "PRIVMSG $nick :$notc Wakss, config file $nicknya GAGAL dibuat"
	return 0
	}

catch { [exec ./run $nicknya] } result2

if {[string match "*/msg*" $result2]} {
	puthlp "PRIVMSG $nick :$notc Done \!\!\!"
	puthlp "PRIVMSG $nick :$notc Ok, Please cek whois BOT $nicknya "
	foreach line2 [split $result2 "\n"] {
	if {[string match "*pid*" $line2]} {
		puthlp "PRIVMSG $nick :$notc $nicknya \: $line2"
		}
	}
	puthlp "NOTICE $ownernya :$notc 4B1uaT 4A1naK"
	puthlp "NOTICE $ownernya :$notc Please Cek bot $nicknya di channel \#$channya"
	puthlp "NOTICE $ownernya :$notc Kalo $nicknya udah join... ketik:"
	puthlp "NOTICE $ownernya :$notc \/msg $nicknya hello"
	puthlp "NOTICE $ownernya :$notc \/msg $nicknya pass \[pass\]"
	puthlp "NOTICE $ownernya :$notc \/msg $nicknya auth \[pass\]"
	puthlp "NOTICE $ownernya :$notc Kalo gak join2 juga berarti ANDA BELUM BERUNTUNG \:p"
	puthlp "NOTICE $ownernya :$notc Makasih ya... "
} else {
	puthlp "PRIVMSG $nick :Permbuatan BoT $nicknya Gagal !!!"
	return 0
	}
}

bind pub n !load proc_load

proc proc_load {nick uhost hand chan rest} {
global notc own basechan owner

global notc own basechan owner

if {![matchattr $nick Q]} {
	putserv "PRIVMSG $nick :$notc Sorry bos $nick ... hanya bos besar yg boleh pake perintah !load"
	putserv "PRIVMSG $nick :$notc Maapin ya.... xixixixi.. \:p"
	return 0 
	}

if { $rest == ""} then {
	putserv "PRIVMSG $chan :$notc 4B1uaT 4A1naK"
	putserv "PRIVMSG $chan :$notc Penggunaan : \!load \[nick\] \[ident\] \[IP\] \[channel\] \[owner\]"
	return 0
	}

set nicknya [lindex $rest 0]
set identnya [lindex $rest 1]
set ipnya [lindex $rest 2]
set channya [lindex $rest 3]
set ownernya [lindex $rest 4]

if {$channya == ""} then { 
	set channya [string trimright $chan #]
	set ownernya $nick
	}

catch { [exec /sbin/ifconfig] } daftarIP
if {[string match "*$ipnya*" $daftarIP]} {
	putserv "PRIVMSG $chan :$notc 4B1uaT 4A1naK"
	putserv "PRIVMSG $chan :$notc Making Eggdrop $nicknya ..."
	putserv "PRIVMSG $chan :$notc IP Ok ..."
	} else {
	return 0
	}

catch { [exec ./ra $nicknya $identnya $ipnya $channya $ownernya] } result1
if {[string match "*ra*" $result1]} {
	putserv "PRIVMSG $chan :$notc File Config Ok ..."
	} else {
	puthlp "PRIVMSG $chan :$notc Error building config file, Process Terminated\!\!\!"
	return 0
	}

catch { [exec ./run $nicknya] } result2

if {[string match "*/msg*" $result2]} {
	puthlp "PRIVMSG $chan :$notc Done \!\!\!"
	puthlp "NOTICE $nick :$notc Ok, Please cek whois BOT $nicknya "
	foreach line2 [split $result2 "\n"] {
	if {[string match "*pid*" $line2]} {
		puthlp "NOTICE $nick :$notc $nicknya \: $line2"
		}
	}
	puthlp "NOTICE $ownernya :$notc 4B1uaT 4A1naK"
	puthlp "NOTICE $ownernya :$notc Please Cek bot $nicknya di channel \#$channya"
	puthlp "NOTICE $ownernya :$notc Kalo $nicknya udah join... ketik:"
	puthlp "NOTICE $ownernya :$notc \/msg $nicknya hello"
	puthlp "NOTICE $ownernya :$notc \/msg $nicknya pass \[pass\]"
	puthlp "NOTICE $ownernya :$notc \/msg $nicknya auth \[pass\]"
	puthlp "NOTICE $ownernya :$notc Kalo gak join2 juga berarti ANDA BELUM BERUNTUNG \:p"
	puthlp "NOTICE $ownernya :$notc Makasih ya... "
} else {
	putserv "NOTICE $nick :Pembuatan BoT $nicknya Gagal !!!"
	}
}

putlog "BoT LoadeR 2.0 by - plaNETWORK TEAM LoADED !!!"

