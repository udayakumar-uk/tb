# Color Auto Kick Script By [-bandila-] 2010
# For the channels that do not support color
# And are sick of people coming in and spamming with color
# This will work in the channels with text and /action (going to work on bold w/color)
# 1.0 (11/10/99) this tcl had to be writin !!!
# 1.1 (11/11/99) someone wanted a tcl that would kick for color Only if they went over
# a set % (that you can set) of text:color

# Thanks goes out to all the people in #mp3-80's@EFNet for letting me test this tcl on them
# And all the people in #eggdrop@undernet for being Very helpful
# Thank you slennox for all the help ! ! !

# Comments Or Sugestions : Email me at : bikini.team@sweden.com
# Thank You !!!!!!!!!!

####################################
####################################
# set a kick msg for the color kick
set kick2 "jangan ba warna olo waaaaaaaaaaaa!!!"

# set the % that will be the max someone can have colored text in a line of text
set percent "30"

#now you are all set ! ! !
####################################
##### Do Not Change Anything Below Here !!!!!!!!
####################################

set badword4 "*\003*"

bind pubm - $badword4 color_kick

proc color_kick {nick host hand chan text} {
global badword4 kick2 percent
 set opped [isop $nick $chan]
 set flag [matchattr $hand f|f $chan]
       if {$flag || $opped} {
       putlog "$nick has the Friend Flag or is opped on $chan"
       putserv "KICK $chan $nick :Biar OP ngana debo qta mo kick klu ba warna.!!!"
       return 0
      }  else {
         if {[botisop $chan]} {
           set prcnt [split $text ""]
           set awq [lsearch $prcnt $badword4]
           set mnb [lrange $prcnt $awq end]
           set txt2 [join $mnb ""]
           append $percent .0
           set prfn [expr ([string length $txt2].0 / [string length $text].0) * 100]
           if {$percent <= $prfn} {
             putlog "*** $nick had $prfn % out of $percent % of color , and was kicked from $chan"
             putserv "KICK $chan $nick :$kick2"
             return 0
           }  else {
              putserv "KICK $chan $nick :Biar OP ngana debo qta mo kick klu ba warna.!!!"
              putlog "*** $nick had $prfn % out of $percent % of color"
              return 0
           }
         }
}}

bind ctcp - "ACTION" kick_actioncolor

proc kick_actioncolor {nick uhost hand chan keyword args} {
global badword4 kick2 percent
 set opped [isop $nick $chan]
 set flag [matchattr $hand f|f $chan]
  if {([string match *\x03* $args]) && ([string toupper $keyword] == "ACTION")} {
    if {$flag || $opped} {
       putlog "$nick has the Friend Flag or is opped on $chan"
       putserv "KICK $chan $nick :Biar OP ngana debo qta mo kick klu ba warna.!!!"
       return 0
      }  else {
         if {[botisop $chan]} {
            set prcnt [split $args ""]
	    set awq [lsearch $prcnt $badword4]
	    set mnb [lrange $prcnt $awq end]
	    set txt2 [join $mnb ""]
	    append $percent .0
	    set prfn [expr ([string length $txt2].0 / [string length $args].0) * 100]
	    if {$percent <= $prfn} {
             putlog "*** $nick had $prfn % out of $percent % of color , and was kicked from $chan"
             putserv "KICK $chan $nick :$kick2"
             return 0
           }  else {
              putserv "KICK $chan $nick : Biar OP ngana debo qta mo kick klu ba warna.!!!"
	      putlog "*** $nick had $prfn % out of $percent % of color"
              return 0
            }
         }
    }
}}




putlog "Color (auto kick) With Ratio by \[-bandila-\] 1999 Loaded"