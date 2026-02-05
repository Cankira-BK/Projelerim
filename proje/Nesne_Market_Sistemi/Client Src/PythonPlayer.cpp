// arat

const TItemData * CPythonPlayer::GetItemData(TItemPos Cell) const

// altýna ekle (bloktan sonra)

#ifdef ENABLE_ITEM_SHOP_SYSTEM
DWORD CPythonPlayer::GetDragonCoin()
{
	return m_dwDragonCoin;
}

DWORD CPythonPlayer::GetDragonMark()
{
	return m_dwDragonMark;
}

void CPythonPlayer::SetDragonCoin(DWORD amount)
{
	m_dwDragonCoin = amount;
}

void CPythonPlayer::SetDragonMark(DWORD amount)
{
	m_dwDragonMark = amount;
}
#endif


// arat

m_inGuildAreaID = 0xffffffff;

// altýna ekle


#ifdef ENABLE_ITEM_SHOP_SYSTEM
	m_dwDragonCoin = 0;
	m_dwDragonMark = 0;
#endif