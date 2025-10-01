####################################################################################
##########
### BEGIN CONFIG
### EDIT THE NEXT LINES
### IF YOU DON'T EDIT THEM, MAYBE THE SCRIPT WILL NOT WORK
##########

### You can choose what the name of the file must be
### when you gonna use this script
set av_file "av.db"

### If you don't want that some channels use this system
### you can put them in the IGNORED variable :D
set ign_chans "#test.channsel"

### You can set here the default option that you want when
### the bot joins the channel.
### 0 = AutoVoice OFF
### 1 = AutoVoice ON
set default_av "1"

### Users that are in the ignore list will not get +v
### when they join the channel. It's better to set it on 1
### 0 = Ignore listed users will get +v
### 1 = Ignore listed users will NOT get +v
set users_ign "1"

##########
### END CONFIG
### DON'T EDIT THE LINES HERE BELOW, IF YOU DON'T KNOW WHAT
### YOU ARE DOING!
##########

### Binds
bind pub m|m .autovoice pub:autovoice
bind pub m|m .av pub:autovoice
bind join - * join:av_check
bind time - "* * * * *" file:save

### When you use .autovoice on/off this command will help you 
### with it. It checks if it isn't a ignored channel and if the auto-voice
### isn't already on/off
proc pub:autovoice {n u h c a} {
global av_all botnick ign_chans
set c [string tolower $c]; set s [string tolower [lindex $a 0]]; set ign_chans [string tolower $ign_chans]
 if {[lsearch $ign_chans $c] < "0"} {
  if {$s == "on" || $s == "off"} {
    if {[info exist av_all($c)]} {
       if {$av_all($c) == "on" && $s == "on"} {
          putserv "NOTICE $n :AutoVoice status \037already\037 on \002\"ON\"\002"
       } elseif {$av_all($c) == "off" && $s == "off"} {
          putserv "NOTICE $n :AutoVoice status \037already\037 on \002\"OFF\"\002"
       } else {
          set av_all($c) "$s"; set stmp [string toupper $s]
          putserv "NOTICE $n :AutoVoice status is now \002\"$stmp\"\002" 
          if {![isop $botnick $c] && $s == "on"} { putserv "NOTICE $n :Oke done, put first I need \002+OP\002 for that"  }
       }
    } else { set av_all($c) "$s"; set stmp [string toupper $s]
       putserv "NOTICE $n :AutoVoice status is now \002\"$stmp\"\002"
       if {![isop $botnick $c] && $s == "on"} { putserv "NOTICE $n :Oke done, put first I need \002+OP\002 for that"  }
    }
  } else { putserv "NOTICE $n :Syntax: \037.autovoice on/off\037" }
 } else { putserv "NOTICE $n :This channel is ignored for using the auto-voice system. Please take contact with the owner of the bot." } 
}

###  In this proc this script will check if the channel is allowed to use auto-voice
### and if it's allowed is the auto-voice on ON?
proc join:av_check {n u h c} {
global av_all botnick default_av ign_chans users_ign
set c [string tolower $c]; set ign_chans [string tolower $ign_chans]
   if {$botnick == $n} { if {$default_av == "1"} { set av_all($c) "on"; } }
   if ([isop $botnick $c]) {
      if {[info exist av_all($c)] && [lsearch $ign_chans $c] < "0" } {
      set host [maskhost *[getchanhost $n $c]]
     	  if {![isignore $host]} { if {$av_all($c) == "on"} { pushmode $c +v $n }
	  } else { if {$users_ign == "0"} { if {$av_all($c) == "on"} { pushmode $c +v $n} } }
      }
   }
}

### Every minute this script saves his data in the file that you have put in $av_file
### Ofcourse it check if the file already exist and if it have already some other channels
### in it so they will not be removed
proc file:save {mi ho da mo ye} {
global av_file av_all
  if {[file exist $av_file]} {
    set fs [open $av_file r] 
    while {![eof $fs]} { 
      gets $fs line; set line "[join $line]"
      if {[llength $line] == 2} {
        set db_c [lindex $line 0]
             if {![info exist av_all($db_c)]} { set av_all($db_c) "[lrange $line 1 1]" }
      }
    }
    close $fs; set fs [open $av_file w+]; foreach db_c [array names av_all] { if {$av_all($db_c) != ""} { puts $fs "$db_c $av_all($db_c)" } }; close $fs 
  } else { set fs [open $av_file w+]; foreach db_c [array names av_all] { if {$av_all($db_c) != ""} { puts $fs "$db_c $av_all($db_c)" } }; close $fs; putlog "Created new file for auto-voice system. The file \002$av_file\002 is created" }
  putcmdlog "Updated system. There are \002[llength [array names av_all]]\002 channels saved in the file \002$av_file\002."
}


### When this script will be started, this proc will work the first, it's read the file $av_file
### and checks the old data to set it in the arrays IF the file exists
proc file:read {} {
global av_file av_all
  if {[file exist $av_file]} {
    set fs [open $av_file r] 
    while {![eof $fs]} { 
      gets $fs line; set line "[join $line]"
      if {[llength $line] == 2} {
        set db_c [lindex $line 0]
             if {![info exist av_all($db_c)]} { set av_all($db_c) "[lrange $line 1 1]" }
      }
    }
    close $fs
  }
}

file:read
putlog "AutoVoice System is \002LOADED\002. (c) Version 1.04 created by \037dbz-gt\037"
