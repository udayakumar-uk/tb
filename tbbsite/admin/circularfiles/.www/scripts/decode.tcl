#################################################################################
# 										                    #
#                      GembelZ-Crew Text De-Encryptor				        #
#										                    #
#  Penggunaan = 							                          #
#               !dc <txt>    decrypt text							  #
#               !dcp <txt>   decrypt juga :)				              #
#               !dezip <txt> decrypt lagi, xixixi			              #
#               !ec <txt>    encrypt text                                       #
#               !rt <txt>    rotate text					              # 
#										                    #
# [Mohon Maaf Bila ada kesalahan dalam TCL ini]				              #
# Thanks To 									              #
#         OneX, all my best friend in dudutz, all crew icc, & Allah Swt         #
#										                    #
#################################################################################

set notc [decrypt 64 "iqlSm0SEI4i0LK.Yb05maZq00sALQ1dkp2g1M9l3a//Y/Yu1jPvAQ0wvQ.E1IweUn1Z8zGf/"]
bind pub - !dc de_crypt
bind pub - !ec en_crypt
bind pub - !dcp decepe
bind pub - !rt putar
bind pub - !dezip de_zip

proc [decrypt 64 "JhUhl/xA0Du/"] {txt} {
global lenc ldec uenc udec
set retval ""
set count [string length $txt]
set status 0
set lst ""
for {set i 0} {$i < $count} {incr i} {
set idx [string index $txt $i] 
if {$idx == "$" && $status == 0} { 
set status 1
set idx "~$idx"
}
if {$idx == [decrypt 64 "uAwNV.ZfVQk."] && $lst != [decrypt 64 "59.TI0HteTn1"] && $status == 0} {
set status 2
set idx "~$idx"
}
if {$idx == " " && $status == 1} {
set status 0
set idx "$idx~"
}
if {$idx == "]" && $status == 2} {
set status 0
set idx "$idx~"
}
if {$status == 0} {
if {[string match *$idx* $lenc]} {
set idx [string range $ldec [string first $idx $lenc] [string first $idx $lenc]]
}
if {[string match *$idx* $uenc]} {
set idx [string range $udec [string first $idx $uenc] [string first $idx $uenc]]
}
}
set lst $idx
append retval $idx
}
regsub -all -- vmw] $retval "end]" retval
return $retval
}

proc putar {nick uhost hand chan rest} {
global notc
set rest [lindex $rest 0]
if {$rest==""} {
putserv "PRIVMSG $chan :$notc Ketik: !rt <string>"
return 1
}
putserv "PRIVMSG $chan :$notc: Hasil = [rotate $rest]"
return 1
}

proc de_crypt {nick uhost hand chan rest} {
global notc
set rest [lindex $rest 0]
if {$rest==""} {
putserv "PRIVMSG $chan :$notc Ketik: !dc <string>"
return 1
}
set retval $rest
regsub ~ $retval "" retval
putserv "PRIVMSG $chan :$notc Hasil = [decrypt 64 $retval]"
}

proc en_crypt {nick uhost hand chan rest} {
global notc
set rest [lindex $rest 0]
if {$rest==""} {
putserv "PRIVMSG $chan :$notc Ketik: !ec <string>"
return 1
}
putserv "PRIVMSG $chan :$notc Hasil = [encrypt 64 $rest]"
}

proc decepe {nick uhost hand chan rest} {
global notc
set rest [lindex $rest 0]
if {$rest==""} {
putserv "PRIVMSG $chan :$notc Ketik: !dcp <string>"
return 1
}
set retval [decrypt 64 $rest]
regsub ~ $retval "" retval
putserv "PRIVMSG $chan :$notc Hasil = [decrypt 64 $retval]"
}

proc de_zip {nick uhost hand chan rest} {
global notc
set rest [lindex $rest 0]
if {$rest==""} {
putserv "PRIVMSG $chan :$notc Ketik: !dezip <string>"
return 1
}
set retval $rest
regsub ~ $retval "" retval
putserv "PRIVMSG $chan :$notc Hasil = [decrypt 64 $retval]"
}

bind pub - deenhelp deen_help
proc deen_help {nick uhost hand chan rest} {
global notc
if {[istimer "HELP STOPED"]} {
putsrv "PRIVMSG $chan :$notc Decode help dalam progress, coba sesaat lagi..!"
return 0
}
set [decrypt 64 "pBYAB0KpuIg.23Nra0kQr5u0"] [decrypt 64 "dPrGg.CFTBr1.mUhF18o5OB0GSLka/TNkCY0HhqKn0ZThS80paYN71bgoKr0"]
set [decrypt 64 "zPmcK0kqGuR0"] [decrypt 64 "CQ97L.pZjxK/4ZCfK/Bo37K.bzMqI00uqaj.ObPCa1G.2oR/iqlSm0SEI4i06868..F.fXh.Hu/2m/JuA0M1"]
timer 2 { putlog "HELP STOPED" }
puthlp "PRIVMSG $nick :$notc GembelZ-Crew De-Encryptor"
puthlp "PRIVMSG $nick :----------------------------------------"
puthlp "PRIVMSG $nick :Cara Penggunaan:"
puthlp "PRIVMSG $nick :  !dc <txt>    decrypt text"
puthlp "PRIVMSG $nick :  !dcp <txt>   decrypt juga :)"
puthlp "PRIVMSG $nick :  !dezip <txt> decrypt lagi, xixixi :p"
puthlp "PRIVMSG $nick :  !ec <txt>    encrypt text"
puthlp "PRIVMSG $nick :  !rt <txt>    rotate text"
puthlp "PRIVMSG $nick :________________________________________"
# puthlp "PRIVMSG $nick :$myteacher"
# puthlp "PRIVMSG $nick :$logox"
return 0
}
