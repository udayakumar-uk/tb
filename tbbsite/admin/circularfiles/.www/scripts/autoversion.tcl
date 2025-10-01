#######################################
## AuToVeRsioN.TcL v1.0 By Conficker ##
##   		© januari 2010	       ##
## #planetwork irc.planetwork.us 	 ##
#######################################
## Notes:
## + Memeriksa versi IRC Client dari user yang join ke channel dan menampilkannya ke channel tertentu

###################
##[ KONFIGURASI ]##
###################
set av_ownchan "#viruses" ;#Channel untuk menampilkan hasil versi
set av_verchan { #viruses } ;#Channel yang di versi, pisahkan dengan spasi

###############
##[ BINDING ]##
###############
bind pub n `autoversion list_av
bind pub n `+autoversion add_av
bind pub n `-autoversion del_av
bind join * * join_versi
bind ctcr * VERSION cek_versi

################
##[ PROSEDUR ]##
################
proc join_versi {nick uhost hand chan} {
  global botnick av_verchan
  foreach x $av_verchan {
    set x [string toupper $x]
    set chan [string toupper $chan]
    if {[string match "$x" $chan]} {
      putlog "«AV» Nick: $nick Chan: $chan"
      putserv "PRIVMSG $nick :\001VERSION\001"
      return 0
    }
  }
}

proc cek_versi {nick uhost hand dest key txt} {
  global av_ownchan
  putserv "PRIVMSG $av_ownchan :$nick: $txt"
}

proc add_bl {nick uhost hand chan arg} {
  global bl_ownchan av_verchan
  foreach x $av_verchan {
    if {[string toupper $x] == [string toupper $arg]} {
      putserv "NOTICE $nick :$arg sudah ada di AutoVersion"
      return 0
    }
  }
  append av_verchan [string tolower $arg]
  putserv "NOTICE $nick :$arg ditambahkan ke AutoVersion"
}

proc del_av {nick uhost hand chan arg} {
  global av_ownchan av_verchan
  set verchan ""
  foreach x $av_verchan {
    if {[string toupper $x] == [string toupper $arg]} {
      putserv "NOTICE $nick :$arg dihapus dari AutoVersion"
    } else {
      append verchan "[string tolower $x] "
    }
  }
  set av_verchan $verchan
}

proc list_av {nick uhost hand chan arg} {
  global av_ownchan av_verchan
  set verchan ""
  foreach x $av_verchan {
    append verchan "$x "
  }
  putserv "NOTICE $nick :\002YourChan:\002\ $av_ownchan \002VersionChan:\002 $verchan"
}

####################################################################
putlog "0,12«0,1 AuToVeRsioN.TcL v1.0 Conficker 0,12» LoaDeD"
####################################################################
