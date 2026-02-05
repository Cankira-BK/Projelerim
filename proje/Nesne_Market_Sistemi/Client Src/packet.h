// arat

HEADER_GC_KEY_AGREEMENT_COMPLETED			= 0xfa,

// üstüne ekle

#ifdef ENABLE_ITEM_SHOP_SYSTEM
	HEADER_GC_ITEM_SHOP = 173, // paket no game ile ayný olsun 
#endif


// arat

typedef struct command_player_select
{
	BYTE	header;
	BYTE	player_index;
} TPacketCGSelectCharacter;



// altýna ekle

#ifdef ENABLE_ITEM_SHOP_SYSTEM
typedef struct SPacketItemShopData
{
	BYTE	header;
	DWORD	id, category, sub_category, vnum, count, coinsold, coins, socketzero, mark;
	DWORD	socket0, socket1, socket2, socket3, socket4, socket5;
	DWORD	type0, type1, type2, type3, type4, type5, type6;
	DWORD	value0, value1, value2, value3, value4, value5, value6;
} TPacketItemShopData;
#endif
