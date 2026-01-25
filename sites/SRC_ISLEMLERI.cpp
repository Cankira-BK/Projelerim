///////////////////////////////////// ItemProto /////////////////////////////////////
//Bul: 50199
//Eþyanýn ITEM_GIFTBOX	0 satýrýný ITEM_USE	USE_SPECIAL olarak deðiþtirin.

///////////////////////////////////// ROOT:uitooltip.py /////////////////////////////////////
//Bul: if item.USE_SPECIAL == itemSubType:
//Altýna ekle
if itemVnum == 50199:
	self.AppendItemSelectName(metinSlot[3])

//Bul: def __AppendFishInfo(self, size):
//Üstüne ekle

	def AppendItemSelectName(self, vnum):
		if vnum >= 10:
			kod = int(vnum)
			item.SelectItem(kod)
			item_isim = item.GetItemName()
			self.AppendTextLine("Ýçindeki Eþya: %s" % item_isim, self.SPECIAL_POSITIVE_COLOR)
		else:
			self.AppendTextLine("Deðersiz Sandýk", self.SPECIAL_POSITIVE_COLOR)

///////////////////////////////////// CHAR_ITEM.CPP /////////////////////////////////////
// Bul: case 70021:
// Üstüne ekle

							case 50199:
								{
									if (GetExchange() || GetMyShop() || GetShopOwner() || IsOpenSafebox() || IsCubeOpen())
									{
										ChatPacket(CHAT_TYPE_INFO, LC_TEXT("°Å·¡Ã¢,Ã¢°í µîÀ» ¿¬ »óÅÂ¿¡¼­´Â ±ÍÈ¯ºÎ,±ÍÈ¯±â¾ïºÎ ¸¦ »ç¿ëÇÒ¼ö ¾ø½À´Ï´Ù."));
										return false;
									}

									int iVnum = item->GetSocket(3);
									if (iVnum >= 10)
									{
										int cell;
										LPITEM item2 = ITEM_MANAGER::instance().CreateItem(iVnum, 1);
										if (!item2)
										{
											sys_err("cannot create item by vnum %u (name: %s)", iVnum, GetName());
											return false;
										}

										if (item2->IsDragonSoul())
											cell = GetEmptyDragonSoulInventory(item2->GetVnum(), item2->GetSubType(), item2->GetSize());
#ifdef UK_ENABLE_SPECIAL_STORAGE
										else if (item2->IsUpgradeItem())
											cell = GetEmptyUpgradeInventory(item2->GetSize());
										else if (item2->IsBook())
											cell = GetEmptyBookInventory(item2->GetSize());
										else if (item2->IsStone())
											cell = GetEmptyStoneInventory(item2->GetSize());
										else if (item2->IsAttr())
											cell = GetEmptyAttrInventory(item2->GetSize());
										else if (item2->IsFlower())
											cell = GetEmptyFlowerInventory(item2->GetSize());
										else if (item2->IsBlendS())
											cell = GetEmptyBlendInventory(item2->GetSize());
#endif
										else
											cell = GetEmptyInventory(item2->GetSize());

										if (-1 == cell)
										{
											ChatPacket(CHAT_TYPE_INFO, LC_TEXT("¼ÒÁöÇ°¿¡ ºó °ø°£ÀÌ ¾ø½À´Ï´Ù."));
											break;
										}
										

										if (item2->IsDragonSoul())
											item2->AddToCharacter(this, TItemPos(DRAGON_SOUL_INVENTORY, cell));
#ifdef UK_ENABLE_SPECIAL_STORAGE
										else if (item2->IsUpgradeItem())
											item2->AddToCharacter(this, TItemPos(UPGRADE_INVENTORY, cell));
										else if (item2->IsBook())
											item2->AddToCharacter(this, TItemPos(BOOK_INVENTORY, cell));
										else if (item2->IsStone())
											item2->AddToCharacter(this, TItemPos(STONE_INVENTORY, cell));
										else if (item2->IsAttr())
											item2->AddToCharacter(this, TItemPos(ATTR_INVENTORY, cell));
										else if (item2->IsFlower())
											item2->AddToCharacter(this, TItemPos(FLOWER_INVENTORY, cell));
										else if (item2->IsBlendS())
											item2->AddToCharacter(this, TItemPos(BLEND_INVENTORY, cell));
#endif
										else
											item2->AddToCharacter(this, TItemPos(INVENTORY, cell));

										if (item->GetSocket(0) != 0)
											item2->SetSocket(0, item->GetSocket(0));
										if (item->GetSocket(1) != 0)
											item2->SetSocket(1, item->GetSocket(1));
										if (item->GetSocket(2) != 0)
											item2->SetSocket(2, item->GetSocket(2));

										if (item->GetAttributeValue(0) != 0)
											item2->SetForceAttribute(0, item->GetAttributeType(0), item->GetAttributeValue(0));
										if (item->GetAttributeValue(1) != 0)
											item2->SetForceAttribute(1, item->GetAttributeType(1), item->GetAttributeValue(1));
										if (item->GetAttributeValue(2) != 0)
											item2->SetForceAttribute(2, item->GetAttributeType(2), item->GetAttributeValue(2));
										if (item->GetAttributeValue(3) != 0)
											item2->SetForceAttribute(3, item->GetAttributeType(3), item->GetAttributeValue(3));
										if (item->GetAttributeValue(4) != 0)
											item2->SetForceAttribute(4, item->GetAttributeType(4), item->GetAttributeValue(4));
										
										item->SetCount(item->GetCount() - 1);
									}
								}
								break;

///////////////////////////////////// CMD_GENERAL.CPP /////////////////////////////////////
//Bul: ACMD(do_in_game_mall)
//Tamamen Deðiþtir

ACMD(do_in_game_mall)
{
	if (LC_IsEurope() == true)
	{
		char country_code[3];

		switch (LC_GetLocalType())
		{
		case LC_GERMANY:	country_code[0] = 'd'; country_code[1] = 'e'; country_code[2] = '\0'; break;
		case LC_FRANCE:		country_code[0] = 'f'; country_code[1] = 'r'; country_code[2] = '\0'; break;
		case LC_ITALY:		country_code[0] = 'i'; country_code[1] = 't'; country_code[2] = '\0'; break;
		case LC_SPAIN:		country_code[0] = 'e'; country_code[1] = 's'; country_code[2] = '\0'; break;
		case LC_UK:			country_code[0] = 'e'; country_code[1] = 'n'; country_code[2] = '\0'; break;
		case LC_TURKEY:		country_code[0] = 't'; country_code[1] = 'r'; country_code[2] = '\0'; break;
		case LC_POLAND:		country_code[0] = 'p'; country_code[1] = 'l'; country_code[2] = '\0'; break;
		case LC_PORTUGAL:	country_code[0] = 'p'; country_code[1] = 't'; country_code[2] = '\0'; break;
		case LC_GREEK:		country_code[0] = 'g'; country_code[1] = 'r'; country_code[2] = '\0'; break;
		case LC_RUSSIA:		country_code[0] = 'r'; country_code[1] = 'u'; country_code[2] = '\0'; break;
		case LC_DENMARK:	country_code[0] = 'd'; country_code[1] = 'k'; country_code[2] = '\0'; break;
		case LC_BULGARIA:	country_code[0] = 'b'; country_code[1] = 'g'; country_code[2] = '\0'; break;
		case LC_CROATIA:	country_code[0] = 'h'; country_code[1] = 'r'; country_code[2] = '\0'; break;
		case LC_MEXICO:		country_code[0] = 'm'; country_code[1] = 'x'; country_code[2] = '\0'; break;
		case LC_ARABIA:		country_code[0] = 'a'; country_code[1] = 'e'; country_code[2] = '\0'; break;
		case LC_CZECH:		country_code[0] = 'c'; country_code[1] = 'z'; country_code[2] = '\0'; break;
		case LC_ROMANIA:	country_code[0] = 'r'; country_code[1] = 'o'; country_code[2] = '\0'; break;
		case LC_HUNGARY:	country_code[0] = 'h'; country_code[1] = 'u'; country_code[2] = '\0'; break;
		case LC_NETHERLANDS: country_code[0] = 'n'; country_code[1] = 'l'; country_code[2] = '\0'; break;
		case LC_USA:		country_code[0] = 'u'; country_code[1] = 's'; country_code[2] = '\0'; break;
		case LC_CANADA:	country_code[0] = 'c'; country_code[1] = 'a'; country_code[2] = '\0'; break;
		default:
			if (test_server == true)
			{
				country_code[0] = 't'; country_code[1] = 'r'; country_code[2] = '\0';
			}
			break;
		}

		char buf[512 + 1];
		char sas[33];
		MD5_CTX ctx;
		const char sas_key[] = "GF9001";

		snprintf(buf, sizeof(buf), "%u%u%s", ch->GetPlayerID(), ch->GetAID(), sas_key);

		MD5Init(&ctx);
		MD5Update(&ctx, (const unsigned char *)buf, strlen(buf));
#ifdef __FreeBSD__
		MD5End(&ctx, sas);
#else
		static const char hex[] = "0123456789abcdef";
		unsigned char digest[16];
		MD5Final(digest, &ctx);
		int i;
		for (i = 0; i < 16; ++i) {
			sas[i + i] = hex[digest[i] >> 4];
			sas[i + i + 1] = hex[digest[i] & 0x0f];
		}
		sas[i + i] = '\0';
#endif

		snprintf(buf, sizeof(buf), "mall http://%s/ishop?pid=%u&c=%s&sid=%d&sas=%s", g_strWebMallURL.c_str(), ch->GetPlayerID(), country_code, 1, sas);
		ch->ChatPacket(CHAT_TYPE_COMMAND, buf);
	}
}
