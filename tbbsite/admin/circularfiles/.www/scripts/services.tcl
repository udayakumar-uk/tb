set cprev "!"
##################################################################################
# VER and CSINFO/NSINFO
##################################################################################
set fromchan "NONE"
set cctarget "NONE"
set fromchancs "NONE"
set cctargetcs "NONE"
set fromchanns "NONE"
set cctargetns "NONE"
##################################################################################

bind pub - "${cprev}version" proc:version
bind pub - "${cprev}csinfo" proc:csinfo
bind pub - "${cprev}nsinfo" proc:nsinfo
bind ctcr - VERSION ctcr:version
bind notc - * notc:version

proc proc:version {nick uhost hand chan text} {
    global botnick fromchan cctarget
    if {[string tolower $nick] != [string tolower $botnick]} {
        set fromchan $chan
        set cctarget [lindex $text 0]
        putquick "PRIVMSG $cctarget :\001VERSION\001"
        return 1
    }
}

proc proc:csinfo {nick uhost hand chan text} {
    global botnick fromchancs cctargetcs
    if {[string tolower $nick] != [string tolower $botnick]} {
        set fromchancs $chan
        set cctargetcs [lindex $text 0]
        putquick "cs info $cctargetcs"
        return 1
    }
}

proc proc:nsinfo {nick uhost hand chan text} {
    global botnick fromchanns cctargetns
    if {[string tolower $nick] != [string tolower $botnick]} {
        set fromchanns $chan
        set cctargetns [lindex $text 0]
        putquick "ns info $cctargetns"
        return 1
    }
}

proc ctcr:version {nick uhost hand dest key arg} {
    global botnick fromchan cctarget
    if {($fromchan == "NONE") || ($cctarget == "NONE")} {return 0}
    if {[string tolower $nick] != [string tolower $botnick]} {
        putquick "PRIVMSG $fromchan :Version reply from $nick: \00304$arg\003"
        set fromchan "NONE"
        set cctarget "NONE"
        return 1
    }
}

proc notc:version {nick uhost hand text {dest ""}} {
    global botnick fromchan cctarget fromchancs cctargetcs fromchanns cctargetns
    if {$dest == ""} { set dest $botnick }
    if {($fromchan != "NONE") && ($cctarget != "NONE")} {
        if {([string tolower $nick] == [string tolower $cctarget]) && ([string match "*version*" [lindex [string tolower $text] 0]])} {
            putquick "PRIVMSG $fromchan :Version reply from $nick: \00304$text\003"
            set fromchan "NONE"
            set cctarget "NONE"
            return 1
        }
    }   
    if {($fromchancs != "NONE") && ($cctargetcs != "NONE")} {
        if {[string tolower $nick] == "chanserv"} {
            putquick "PRIVMSG $fromchancs :\00306$text\003"
            if {[string match "*end of info*" [zzstripcodes [string tolower $text]]]} {
                set fromchancs "NONE"
                set cctargetcs "NONE"
                return 1
            }
        }
    }
    if {($fromchanns != "NONE") && ($cctargetns != "NONE")} {
        if {[string tolower $nick] == "nickserv"} {
            putquick "PRIVMSG $fromchanns :\00306$text\003"
            if {[string match "*end of info*" [zzstripcodes [string tolower $text]]]} {
                set fromchanns "NONE"
                set cctargetns "NONE"
                return 1
            }
        }
    }
}

##################################################################################
# WHOIS
##################################################################################

bind pub - "${cprev}whois" whois:nick

proc whois:nick { nickname hostname handle channel arguments } {
    global whois
    set target [lindex [split $arguments] 0]
    if {$target == ""} {
        putquick "PRIVMSG $channel :embeeeeeek -winampv9- ."
        return 0
    }
    putquick "WHOIS $target $target"
    set ::whoischannel $channel
    set ::whoistarget $target
    bind RAW - 401 whois:nosuch
    bind RAW - 311 whois:info
    bind RAW - 319 whois:channels
    bind RAW - 312 whois:server
    bind RAW - 301 whois:away
    bind RAW - 313 whois:ircop
    bind RAW - 317 whois:idle
    bind raw - 338 whois:host
    bind raw - 318 whois:eof
}

proc whois:putmsg { channel arguments } {
    putquick "PRIVMSG $channel :\00306$arguments\003"
}

proc whois:info { from keyword arguments } {
    set channel $::whoischannel
    set nickname [lindex [split $arguments] 1]
    set ident [lindex [split $arguments] 2]
    set host [lindex [split $arguments] 3]
    set realname [string range [join [lrange $arguments 5 end]] 1 end]
    whois:putmsg $channel "$nickname is $ident@$host * $realname"
    unbind RAW - 311 whois:info
}

proc whois:ircop { from keyword arguments } {
    set channel $::whoischannel
    set target $::whoistarget
    whois:putmsg $channel "$target is an IRC Operator"
    unbind RAW - 313 whois:ircop
}

proc whois:away { from keyword arguments } {
    set channel $::whoischannel
    set target $::whoistarget
    set awaymessage [string range [join [lrange $arguments 2 end]] 1 end]
    whois:putmsg $channel "$target is away: $awaymessage"
    unbind RAW - 301 whois:away
}

proc whois:channels { from keyword arguments } {
    set channel $::whoischannel
    set channels [string range [join [lrange $arguments 2 end]] 1 end]
    set target $::whoistarget
    whois:putmsg $channel "$target on $channels"
    unbind RAW - 319 whois:channels
}

proc whois:server { from keyword arguments } {
    set channel $::whoischannel
    set server [lindex [split $arguments] 2]
    set info [string range [join [lrange $arguments 3 end]] 1 end]
    set target $::whoistarget
    whois:putmsg $channel "$target using $server $info"
    unbind raw - 312 whois:server
}

proc whois:nosuch { from keyword arguments } {
    set channel $::whoischannel
    set target $::whoistarget
    whois:putmsg $channel "No such nickname \"$target\""
    unbind RAW - 401 whois:nosuch
}

proc whois:idle { from keyword arguments } {
    set channel $::whoischannel
    set target $::whoistarget
    set idletime [lindex [split $arguments] 2]
    set signon [lindex [split $arguments] 3]
    whois:putmsg $channel "$target has been idle for [duration $idletime]. signon time [ctime $signon]"
    unbind RAW - 317 whois:idle
}

proc whois:host { from keyword arguments }  {
    set channel $::whoischannel
    set target $::whoistarget
    set hostname [lindex [split $arguments] 2]
    whois:putmsg $channel "$target actually using host $hostname"
    unbind raw - 338 whois:auth
}

proc whois:eof { from keyword arguments } {
    set channel $::whoischannel
    set target $::whoistarget
    set eof [string range [join [lrange [split $arguments] 2 end]] 1 end]
    whois:putmsg $channel "$target $eof"
    unbind raw - 318 whois:eof
}

##################################################################################
# CTCP VERSION/FINGER REPLY
##################################################################################
bind ctcp - VERSION ctcppingreply
proc ctcppingreply {nick uhost hand dest key arg} {
    global botnick
    putserv "NOTICE $nick :\001VERSION mIRC v6.35 Khaled Mardam-Bey\001"
    return 1
}

bind ctcp - FINGER ctcpfingerreply
proc ctcpfingerreply {nick uhost hand dest key arg} {
    global botnick
    putserv "NOTICE $nick :\001FINGER mIRC v6.35 Khaled Mardam-Bey\001"
    return 1
}

##################################################################################
# UTILS
##################################################################################
proc zzstripcodes {text} {
    regsub -all -- "\003(\[0-9\]\[0-9\]?(,\[0-9\]\[0-9\]?)?)?" $text "" text
    regsub -all -- "\t" $text " " text
    set text "[string map -nocase [list \002 "" \017 "" \026 "" \037 ""] $text]"
    return $text
}

putlog "ztools.tcl loaded....."