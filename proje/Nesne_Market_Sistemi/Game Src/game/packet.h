// arat

HEADER_CG_STATE_CHECKER					= 206,

// altýna ekle

#ifdef _ITEM_SHOP_SYSTEM
	HEADER_GC_ITEM_SHOP			= 173, // paket no sizde olabilir ona göre deðiþtiriniz
#endif


// arat

HEADER_GG_CHECK_AWAKENESS		= 29,


// altýna ekle 


#ifdef _ITEM_SHOP_SYSTEM
	HEADER_GG_NESNE = 32, // paket no sizde olabilir ona göre deðiþtiriniz
#endif


// arat


typedef struct SPacketGGLogin


// bloktan sonra altýna ekle 

#ifdef _ITEM_SHOP_SYSTEM
typedef struct SPacketGGNesne
{
	BYTE    bHeader;
} TPacketGGNesne;
#endif


// arat

typedef struct packet_add_char


// üstüne ekle 

#ifdef _ITEM_SHOP_SYSTEM
typedef struct SPacketItemShopData
{
	BYTE	header;
	DWORD	id,category,sub_category, vnum, count, coinsold, coins, socketzero, mark;
	DWORD	socket0, socket1, socket2, socket3, socket4, socket5;
	DWORD	type0, type1, type2, type3, type4, type5, type6;
	DWORD	value0, value1, value2, value3, value4, value5, value6;
} TPacketItemShopData;
#endif