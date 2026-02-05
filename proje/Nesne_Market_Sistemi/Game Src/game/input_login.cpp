// en üste ekle
#ifdef _ITEM_SHOP_SYSTEM
#include "item_shop.h"
#endif


// arat

marriage::CManager::instance().Login(ch);

// altýna ekle (Eðer 400 üzeri item ekleyecekseniz nesne markete efsunlu þekilde burayý devre dýþý býrakmanýz saðlýklý olur.)
#ifdef _ITEM_SHOP_SYSTEM
	CItemShopManager::instance().SendClientPacket(ch);
	ch->RefreshDragonCoin();
#endif