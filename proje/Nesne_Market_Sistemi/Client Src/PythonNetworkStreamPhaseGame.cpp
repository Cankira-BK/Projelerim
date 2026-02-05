// ara

			case HEADER_GC_DRAGON_SOUL_REFINE:
				ret = RecvDragonSoulRefine();
				break;


// altýna ekle

#ifdef ENABLE_ITEM_SHOP_SYSTEM
			case HEADER_GC_ITEM_SHOP:
				ret = RecvItemShopData();
				break;
#endif


// arat

bool CPythonNetworkStream::SendDragonSoulRefinePacket(BYTE bRefineType, TItemPos* pos)


// altýna ekle () bloktan sonra


#ifdef ENABLE_ITEM_SHOP_SYSTEM
bool CPythonNetworkStream::RecvItemShopData()

{
	TPacketItemShopData p;
	if (!Recv(sizeof(TPacketItemShopData), &p))
	{
		Tracenf("Recv TPacketItemShopData Packet Error");
		return false;
	}

	PyCallClassMemberFunc(m_apoPhaseWnd[PHASE_WINDOW_GAME], "BINARY_ITEM_SHOP_DATA", Py_BuildValue("(iiiiiiiiiiiiiiiiiiiiiiiiiiiii)", p.id, p.category, p.sub_category, p.vnum, p.count, p.coinsold, p.coins, p.socketzero, p.mark, p.socket0, p.socket1, p.socket2, p.socket3, p.socket4, p.socket5, p.type0, p.value0, p.type1, p.value1, p.type2, p.value2, p.type3, p.value3, p.type4, p.value4, p.type5, p.value5, p.type6, p.value6));
	return true;
}
#endif