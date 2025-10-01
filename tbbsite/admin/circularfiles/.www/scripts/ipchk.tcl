#!/usr/bin/tclsh

namespace eval IPCHK {
  
  variable trigger "!ip" ;# channel trigger
  variable channel "$basechan" ;
  variable flag "-" ;# this flag decides who gets to use your trigger
  variable ismode "0" ;# 0 public, 1: user needs to be voiced, 2:user needs halfops, 3: user needs ops

  variable IPCHKip "PRIVMSG %c% :IPCHK lookup for \(%i%\) is \(\%f%\)." ;# lookup ipaddr
  variable IPCHKnick "PRIVMSG %c% :IPCHK lookup for \(%i%\) is \(%f%\)." ;# lookup nickname
  variable IPCHKhost "PRIVMSG %c% :IPCHK lookup for \(%i%\) is \(%f%\)." ;# lookup hostname

  variable invalid "NOTICE %n% :Error usage: $trigger <nick|host|ip>." 
  variable unknown "PRIVMSG %c% :There are no results for \(%i%\)."
  variable dnserror "PRIVMSG %c% :Error couldn't associate an valid ip with \(%i%\)." 
  variable notonchan "PRIVMSG %c% :Error \(%i%\) is not on \(%c%\)." ;# user is not on channel

  variable version "0.7"
  variable longversion "1121868771"

  proc IPCHK_pub {nick host hand chan arg} {
    variable invalid; variable IPCHKip; variable unknown; variable notonchan
    if {[ischan $chan] && [ismode $nick $chan]} {
      if {[llength $arg] && ([llength $arg] < 2)} {
        if {[isip $arg]} {
          if {[catch {socket -async IPCHK.ofloo.net 80} s]} {
            putlog "Error couldn't connect to webserver plz inform the webmaster at http://www.ofloo.net/."
            putserv [string map [list %n% $nick %h% $hand %i% $arg %c% $chan %k% {} %l% {} %f% {}] $unknown] -next
          } else {
          	fileevent $s writable [list [namespace current]::async_callback_ip $s $arg $nick $hand $chan $arg]
          }
        } elseif {[ishost $arg]} {
          dnslookup $arg [namespace current]::dns_callback_host $nick $hand $chan $arg
        } elseif {[onchan $arg $chan]} {
          dnslookup [lindex [split [getchanhost $arg] \x40] end] [namespace current]::dns_callback_nick $nick $hand $chan $arg
        } elseif {![onchan $arg $chan]} {
          putserv [string map [list %n% $nick %h% $hand %i% $arg %c% $chan %k% {} %l% {} %f% {}] $notonchan] -next
        } else {
          putserv [string map [list %n% $nick %h% $hand %i% $arg %c% $chan %k% {} %l% {} %f% {}] $invalid] -next
        }
      } else {
      	putserv [string map [list %n% $nick %h% $hand %i% $arg %c% $chan %k% {} %l% {} %f% {}] $invalid] -next
      }
    }
  }

  proc dns_callback_nick {ip host status nick hand chan arg} {
   variable dnserror; variable unknown
    if {$status} {
      if {[catch {socket -async IPCHK.ofloo.net 80} s]} {
        putlog "Error couldn't connect to webserver plz inform the webmaster at http://www.ofloo.net/."
        putserv [string map [list %n% $nick %h% $hand %i% $arg %c% $chan %k% {} %l% {} %f% {}] $unknown] -next
      } else {
       	fileevent $s writable [list [namespace current]::async_callback_nick $s $ip $nick $hand $chan $arg]
      }
    } else {
    	putserv [string map [list %n% $nick %h% $hand %i% $arg %c% $chan %k% {} %l% {} %f% {}] $dnserror] -next
    }
  }

  proc dns_callback_host {ip host status nick hand chan arg} {
    variable dnserror; variable unknown
    if {$status} {
      if {[catch {socket -async IPCHK.ofloo.net 80} s]} {
        putlog "Error couldn't connect to webserver plz inform the webmaster at http://www.ofloo.net/."
        putserv [string map [list %n% $nick %h% $hand %i% $arg %c% $chan %k% {} %l% {} %f% {}] $unknown] -next
      } else {
       	fileevent $s writable [list [namespace current]::async_callback_host $s $ip $nick $hand $chan $arg]
      }
    } else {
    	putserv [string map [list %n% $nick %h% $hand %i% $arg %c% $chan %k% {} %l% {} %f% {}] $dnserror] -next
    }
  }

  proc async_callback_host {s ip nick hand chan arg} {
    variable IPCHKhost; variable unknown; variable version
    if {[string equal {} [fconfigure $s -error]]} {
      flush $s
    	puts $s "GET /[ip2longip $ip] HTTP/1.1"
      puts $s "Host: IPCHK.ofloo.net"
      puts $s "Connection: Close"
      puts $s "User-Agent: Ip-to-Country lookup script version $version\n"
      flush $s
      while {![eof $s]} {
        gets $s x
        if {[regexp -nocase {<resolve[\x20]{0,100}c02="([a-z]{2})"[\x20]{0,100}c03="([a-z]{3})"[\x20]{0,100}full="(.*?)"[\x20]{0,100}/>} $x -> k l f]} {
          putserv [string map [list %n% $nick %h% $hand %i% $arg %c% $chan %k% $k %l% $l %f% [wFormat $f]] $IPCHKhost] -next
          break
        }
      }
      close $s
      if {![info exists k]} {
        putserv [string map [list %n% $nick %h% $hand %i% $arg %c% $chan %k% {} %l% {} %f% {}] $unknown] -next
      }
    } else {
    	putlog "Error couldn't connect to webserver plz inform the webmaster at http://www.ofloo.net/."
    }
  }

  proc async_callback_nick {s ip nick hand chan arg} {
    variable IPCHKnick; variable unknown; variable version
    if {[string equal {} [fconfigure $s -error]]} {
      flush $s
    	puts $s "GET /[ip2longip $ip] HTTP/1.1"
      puts $s "Host: IPCHK.ofloo.net"
      puts $s "Connection: Close"
      puts $s "User-Agent: Ip-to-Country lookup script version $version\n"
      flush $s
      while {![eof $s]} {
        gets $s x
        if {[regexp -nocase {<resolve[\x20]{0,100}c02="([a-z]{2})"[\x20]{0,100}c03="([a-z]{3})"[\x20]{0,100}full="(.*?)"[\x20]{0,100}/>} $x -> k l f]} {
          putserv [string map [list %n% $nick %h% $hand %i% $arg %c% $chan %k% $k %l% $l %f% [wFormat $f]] $IPCHKnick] -next
          break
        }
      }
      close $s
      if {![info exists k]} {
        putserv [string map [list %n% $nick %h% $hand %i% $arg %c% $chan %k% {} %l% {} %f% {}] $unknown] -next
      }
    } else {
    	putlog "Error couldn't connect to webserver plz inform the webmaster at http://www.ofloo.net/."
    }
  }

  proc async_callback_ip {s ip nick hand chan arg} {
    variable IPCHKip; variable unknown; variable version
    if {[string equal {} [fconfigure $s -error]]} {
      flush $s
    	puts $s "GET /[ip2longip $arg] HTTP/1.1"
      puts $s "Host: IPCHK.ofloo.net"
      puts $s "Connection: Close"
      puts $s "User-Agent: Ip-to-Country lookup script version $version\n"
      flush $s
      while {![eof $s]} {
        gets $s x
        if {[regexp -nocase {<resolve[\x20]{0,100}c02="([a-z]{2})"[\x20]{0,100}c03="([a-z]{3})"[\x20]{0,100}full="(.*?)"[\x20]{0,100}/>} $x -> k l f]} {
          putserv [string map [list %n% $nick %h% $hand %i% $arg %c% $chan %k% $k %l% $l %f% [wFormat $f]] $IPCHKip] -next
          break
        }
      }
      close $s
      if {![info exists k]} {
        putserv [string map [list %n% $nick %h% $hand %i% $arg %c% $chan %k% {} %l% {} %f% {}] $unknown] -next
      }
    } else {
    	putlog "Error couldn't connect to webserver plz inform the webmaster at http://www.ofloo.net/."
    }
  }

  proc wFormat {arg} {
    foreach {w} [string tolower $arg] {
      if {[info exists word]} {unset word}
      foreach x [split $w {}] {
        if {[info exists word]} {
          append word $x
        } else {
    	    append word [string toupper $x]
        }
      }
      lappend str $word
    }
    return $str
  }

  proc longip2ip {long} {
    return [join [scan [format %.8x $long] %2x%2x%2x%2x] \x2e]
  }
  proc ip2longip {ip} {
    return [format %u 0x[eval format %.2x%.2x%.2x%.2x [split $ip \x2e]]]
  }


  proc isip {ip} {
    if {[regexp {^([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})$} $ip -> a b c d]} {
      if {($a <= 255) && ($b <= 255) && ($c <= 255) && ($d <= 255)} {
        return 1
      }
    }
    return 0
  }

  proc ishost {host} {
    if {[regexp -nocase {[a-z\-]{1,100}\.[a-z]{2,4}$} $host]} {
      return 1
    }
    return 0
  }

  proc ischan {chan} {
    variable channel
    foreach {x} [split $channel \x2c] {
      if {[string equal -nocase $x $chan]} {
        return 1
      }
    }
    return 0
  }

  proc ismode {nick chan} {
    variable ismode
    switch  -exact $ismode {
      "0" {
        return 1
      }
      "1" {
        if {[isvoice $nick $chan] || [ishalfop $nick $chan] || [isop $nick $chan]} {
          return 1 
        }
      }
      "2" {
        if {[ishalfop $nick $chan] || [isop $nick $chan]} {
          return 1 
        }
      }
      "3" {
        if {[isop $nick $chan]} {
          return 1 
        }
      }
    }
    return 0
  }

  bind pub $flag $trigger [namespace current]::IPCHK_pub

  putlog "Loaded IPCHKountry by terroris"

}

