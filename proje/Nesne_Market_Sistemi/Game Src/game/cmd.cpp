// müsait biryere ekle

#ifdef _ITEM_SHOP_SYSTEM
ACMD(do_nesne_market);
ACMD(do_nesneyenile);
#endif

#ifdef _ITEM_SHOP_SYSTEM
	{ "nesne_market", do_nesne_market,	0,	POS_DEAD, GM_PLAYER },
	{ "nesneyenile", do_nesneyenile,	0,	POS_DEAD, GM_PLAYER },
#endif