// arat

#include "log.h"

// altýna ekle

#ifdef _ITEM_SHOP_SYSTEM
#include "item_shop.h"
#endif


// en alta ekle


#ifdef _ITEM_SHOP_SYSTEM
ACMD(do_nesne_market)
{
	if (!ch)
		return;
	
	if (!ch->GetDesc())
		return;
	
	if (!ch->IsPC())
		return;

	if (ch->IsStun())
		return;

	if (ch->IsHack())
		return;
	
#ifdef _AURA_SYSTEM
	if (ch->isAuraOpened(true) || ch->isAuraOpened(false))
	{
		ch->ChatPacket(CHAT_TYPE_COMMAND, "ShopSearchOpen 1");
		return;
	}
#endif
	
	#ifdef __ENABLE_NEW_OFFLINESHOP__
	if (ch->GetOfflineShopGuest() != NULL || ch->GetAuctionGuest() != NULL)
	{
		ch->ChatPacket(CHAT_TYPE_INFO, LC_TEXT("PLEASE_BEFORE_CLOSE_WINDOW_AND_USE_THIS_FUNCTION"));
		return;
	}
#endif
#ifdef ENABLE_ACCE_SYSTEM
	if (ch->isAcceOpened(true) || ch->isAcceOpened(false))
	{
		ch->ChatPacket(CHAT_TYPE_INFO, LC_TEXT("PLEASE_BEFORE_CLOSE_WINDOW_AND_USE_THIS_FUNCTION"));
		return;
	}
#endif
	if (ch->GetExchange() || ch->GetMyShop() || ch->GetShopOwner() || ch->IsOpenSafebox() || ch->IsCubeOpen() || ch->IsDead())
	{
		ch->ChatPacket(CHAT_TYPE_COMMAND, "ShopSearchOpen 1");
		return;
	}

	if (quest::CQuestManager::instance().GetPCForce(ch->GetPlayerID())->IsRunning() == true)
		return;
	
	char arg1[256], arg2[256];
	two_arguments(argument, arg1, sizeof(arg1), arg2, sizeof(arg2));

	DWORD id = 0;
	DWORD count = 0;

	if (!*arg1 || !*arg2)
		return;

	str_to_number(id, arg1);
	str_to_number(count, arg2);

	bool bRes = CItemShopManager::instance().Buy(ch, id, count); // buy func
	if (bRes)
		ch->ChatPacket(CHAT_TYPE_INFO, LC_TEXT("nesnemarketbasarili"));
}
ACMD(do_nesneyenile)
{
	if (!ch)
		return;
	
	if (!ch->GetDesc())
		return;
	
	if (!ch->IsPC())
		return;

	if (ch->IsStun())
		return;

	if (ch->IsHack())
		return;
	
#ifdef _AURA_SYSTEM
	if (ch->isAuraOpened(true) || ch->isAuraOpened(false))
	{
		ch->ChatPacket(CHAT_TYPE_COMMAND, "ShopSearchOpen 1");
		return;
	}
#endif
	
	#ifdef __ENABLE_NEW_OFFLINESHOP__
	if (ch->GetOfflineShopGuest() != NULL || ch->GetAuctionGuest() != NULL)
	{
		ch->ChatPacket(CHAT_TYPE_INFO, LC_TEXT("PLEASE_BEFORE_CLOSE_WINDOW_AND_USE_THIS_FUNCTION"));
		return;
	}
#endif
#ifdef ENABLE_ACCE_SYSTEM
	if (ch->isAcceOpened(true) || ch->isAcceOpened(false))
	{
		ch->ChatPacket(CHAT_TYPE_INFO, LC_TEXT("PLEASE_BEFORE_CLOSE_WINDOW_AND_USE_THIS_FUNCTION"));
		return;
	}
#endif
	if (ch->GetExchange() || ch->GetMyShop() || ch->GetShopOwner() || ch->IsOpenSafebox() || ch->IsCubeOpen() || ch->IsDead())
	{
		ch->ChatPacket(CHAT_TYPE_COMMAND, "ShopSearchOpen 1");
		return;
	}

	if (quest::CQuestManager::instance().GetPCForce(ch->GetPlayerID())->IsRunning() == true)
		return;
	
	
	CItemShopManager::instance().SendClientPacket(ch); // buy func

}
#endif