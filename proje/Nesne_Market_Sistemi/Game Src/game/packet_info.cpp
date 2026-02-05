// arat

	Set(HEADER_GG_LOGIN_PING,		sizeof(TPacketGGLoginPing),	"LoginPing", false);

// altýna ekle

#ifdef _ITEM_SHOP_SYSTEM
	Set(HEADER_GG_NESNE,		sizeof(TPacketGGNesne),	"Nesne", false);
#endif