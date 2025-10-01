####################################
## Ping.TcL Edited By DurjanA     ##
## © Sep 2011, Gembelz Crew       ##
## #GembelZ@allnetwork.org 	      ##
####################################

###################
##[ KONFIGURASI ]##
###################
set mode_pesan 0 ;# 0 (Channel), 1 (Query)
set fp(normal) 5 ;# Batas normal, masih aman
set fp(sedang) 10 ;# Batas sedang, lebih dari ini dinyatakan lag parah :P

##################
##[ PESAN PONG ]##
##################
# <nick> - Nick, <durasi> - Durasi dalam detik
set pong_normal {
"Pong <nick> cuma <durasi> santai saja aaa ;)"
"Tenang saja jow <nick>..! bo <durasi> ente pe lag"
"Seep..<nick> te lag NT, cuma <durasi>"
"Mantap <nick>! <durasi> aja tingkatkan sleding"
"<durasi> kok <nick> tambah pv lagi"
"jah! te usah ping pong trus <nick> juw cuma <durasi> nana p lag"
"Pung pong peng <nick>.. kwekwkekwek cuma <durasi>"
"<nick> masih normal NT kawan. <durasi> TO!!"
"Balasan <nick> OK! <durasi>"
}
set pong_sedang {
"<durasi> lumayan nana <nick> am"
"Ew.. Lagnya <nick> <durasi>"
"heuehueh.. si <nick> so mulai lag <durasi> atiolo.."
"wew.. <nick> telat <durasi>"
"Aahah.. hati2 dengan <durasi> itu <nick> biasa mo DC klu so mulai lag"
"waaaaaaaa.. <nick> so mulai te normal NT ini uam, Lag : <durasi> jangan talalu banyak b pv utis"
"hmm.. udah <durasi> <nick>.."
}
set pong_lag {
"Payah <nick>! Pong lag <durasi> mampus datang ambe jo p dia Tuhan hkhkhkhkhk.."
"Wakz!! Lag <nick> <durasi> ??? jgn kuat b pv utis :P~"
"<nick> telat <durasi>. Jiakakakak.. bgmn ta cuma kase byk pv"
"Wkwkwkw.. DC-in aja deh <nick>. Lagnya udah <durasi>"
"behh.. te salah itu <nick> <durasi> ngn p lag ini blh mo bli akan rokok"
"hihihihi..<nick> somo DC nga uamu <durasi> so itu PV jangan kase banyak"
"gagagaga.. <nick> mending ganti server.. nana p lag <durasi>"
"wekz.. <nick> nga p lag so boleh b panjar akn kpla bentor -->> <durasi>"
"Ck ck ck ck .. <nick> knpa so sampe <durasi> bagini ehk .. wkwkwk.. atikou"
}

###############
##[ BINDING ]##
###############
bind pub * !ping ping_saya
bind pub * ping ping_saya
bind ctcr * PING balasan_ping

################
##[ PROSEDUR ]##
################
proc ping_saya {nick uhost hand chan txt} {
  global pnick pchan
  set txt [string toupper $txt]
  if {$txt == "" || [string match "#*" $txt]} {
    puthelp "NOTICE $nick :Penggunaan: ping <me/nick>"
    return 0
  } elseif {$txt == "ME"} {
    putserv "PRIVMSG $nick :\001PING [unixtime]\001"
    set pnick $nick
    set pchan $chan
    return 1
  } else {
    putserv "PRIVMSG $txt :\001PING [unixtime]\001"
    set pnick $nick
    set pchan $chan
    return 1
  }
}

proc balasan_ping {nick uhost hand dest key txt} {
  global botnick mode_pesan fp pong_normal pong_sedang pong_lag pnick pchan
  if {[string match {*[a-z]*} $txt] || [string match {*[A-Z]*} $txt] } {
    putlog "Invalid Pong!"
    return 0
  }
  if {$nick != $botnick} {
    set durasi "[expr [unixtime] - $txt]"
    if {$durasi < $fp(normal)} {
      set komentar [lindex $pong_normal [rand [llength $pong_normal]]]
    } elseif {$durasi < $fp(sedang)} {
      set komentar [lindex $pong_sedang [rand [llength $pong_sedang]]]
    } else {
      set komentar [lindex $pong_lag [rand [llength $pong_lag]]]
    }
    regsub -all "<nick>" $komentar "$nick hm" komentar
    regsub -all "<durasi>" $komentar "$durasi detik" komentar
    if { $mode_pesan == 0 } {
      putserv "PRIVMSG $pchan :$komentar"
    } else {
      putserv "PRIVMSG $pnick :$komentar"
    }
  }
}

################################################################
putlog "0,12«0,1 PiNg.TcL Edited By DurjanA0,12» LoaDeD"
################################################################
