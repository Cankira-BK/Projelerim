// en üste ekle


#ifdef _ITEM_SHOP_SYSTEM
	#include "item_shop.h"
#endif

// Arat

ACMD(do_reload)

// bul içinde

			case 'p':
				ch->ChatPacket(CHAT_TYPE_INFO, "Reloading prototype tables,");
				db_clientdesc->DBPacket(HEADER_GD_RELOAD_PROTO, 0, NULL, 0);
				break;


// altýna ekle

#ifdef _ITEM_SHOP_SYSTEM	
			case 'n':	
				CItemShopManager::instance().LoadItemShopTable();
				ch->ChatPacket(CHAT_TYPE_INFO, "Yenilediniz:  Nesne market!");
				TPacketGGNesne pggnesne;
				pggnesne.bHeader = HEADER_GG_NESNE;
				P2P_MANAGER::instance().Send(&pggnesne, sizeof(TPacketGGNesne));
				break;
#endif