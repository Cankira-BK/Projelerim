// arat

			Set(HEADER_GC_PARTY_UNLINK,	CNetworkPacketHeaderMap::TPacketType(sizeof(TPacketGCPartyUnlink), STATIC_SIZE_PACKET));

// altýna ekle

#ifdef ENABLE_ITEM_SHOP_SYSTEM
			Set(HEADER_GC_ITEM_SHOP,	CNetworkPacketHeaderMap::TPacketType(sizeof(TPacketItemShopData), STATIC_SIZE_PACKET));
#endif