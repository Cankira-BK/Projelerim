## ConstInfo.py

içine ekle

NESNE_MARKET = 0

###################################

## game.py

## importlar arasýna ekle

if app.ENABLE_ITEM_SHOP_SYSTEM:
	import uiItemShop


## arat

			"PlayMusic"				: self.__PlayMusic,

## ÜSTÜNE EKLE ÜSTÜNE ÜSTÜNE ÜSTÜNE

			"ItemShopDataClear"			:	self.BINARY_ITEM_SHOP_DATA_CLEAR,


## arat

	def OnUpdate(self):

## hemen altýna ekle

		if 1== constInfo.NESNE_MARKET:
			self.interface.OpenItemShop()
			constInfo.NESNE_MARKET = 0


## arat
def __PartyRequestQuestion(self, vid):


## Üstüne ekle


	def BINARY_ITEM_SHOP_DATA_CLEAR(self):
		self.interface.RefreshItemShop()


	def BINARY_ITEM_SHOP_DATA(self, id, category, sub_category, vnum, count, coinsold, coins, socketzero, mark , socket0, socket1, socket2, socket3, socket4, socket5, type0, value0, type1, value1, type2, value2, type3, value3, type4, value4, type5, value5, type6, value6):
		if not constInfo.ITEM_DATA.has_key(category):
			constInfo.ITEM_DATA[category] = {}

		if not constInfo.ITEM_DATA[category].has_key(sub_category):
			constInfo.ITEM_DATA[category][sub_category] = []
			
		metinSlot = [socket0, socket1, socket2, socket3, socket4, socket5]
		attrslot = [(type0, value0), (type1, value1), (type2, value2), (type3, value3), (type4, value4), (type5, value5), (type6, value6)]
		
		item.SelectItem(vnum)
		constInfo.ITEM_DATA[category][sub_category].append((None, id, vnum,coins, coinsold, count, socketzero, mark, metinSlot, attrslot))
		constInfo.ITEM_SEARCH_DATA.append((self.toLower(item.GetItemName()), id, vnum,coins, coinsold, count, socketzero, mark, metinSlot, attrslot))

####################################################################################

## interfacemodule.py

## importlar arasýna ekle

if app.ENABLE_ITEM_SHOP_SYSTEM:
	import uiItemShop


## arat

self.wndEnergyBar = wndEnergyBar

## altýna ekle

		if app.ENABLE_ITEM_SHOP_SYSTEM:
			self.wndTaskBar.BindInterface(self)

## arat

def __MakeHelpWindow(self):

## ÜSTÜNE EKLE ÜSTÜNE ÜSTÜNE

		if app.ENABLE_ITEM_SHOP_SYSTEM:
			self.ItemShop = uiItemShop.ItemShopWindow(self)
			self.ItemShop.LoadWindow()
			self.ItemShop.Close()
		else:
			self.ItemShop = None

## arat

self.dlgExchange.SetItemToolTip(self.tooltipItem)

## altýna ekle

		if app.ENABLE_ITEM_SHOP_SYSTEM:
			self.ItemShop.SetItemToolTip(self.tooltipItem)

## arat

		if self.wndDragonSoulRefine:
			self.wndDragonSoulRefine.Hide()
			self.wndDragonSoulRefine.Destroy()

## altýna ekle

		if app.ENABLE_ITEM_SHOP_SYSTEM:
			if self.ItemShop:
				self.ItemShop.Close()
				self.ItemShop.Destroy()
				self.ItemShop = None
				del self.ItemShop


## arat

def OpenWebWindow(self, url):

##altýna ekle

	def RefreshItemShop(self):
		constInfo.ITEM_DATA = {}
		constInfo.ITEM_SEARCH_DATA = []
		if self.ItemShop:
			self.ItemShop.RefreshProcess()
			# self.ItemShop.Destroy()
		
	def OpenItemShop(self):
		if self.ItemShop:
			
			self.ItemShop.LoadWindow()
			net.SendChatPacket("/nesneyenile")
			self.ItemShop.Open()


#####################################################################

## localeinfo.py

## en alta ekle

if app.ENABLE_ITEM_SHOP_SYSTEM:
	def DO_YOU_BUY_ITEM_COINS(buyItemCount, buyItemPrice) :
		return DO_YOU_BUY_ITEM_C % ( buyItemCount, buyItemPrice )
	def PrettyNumber(n) :
		if n <= 0 :
			return "0"

		return "%s" % ('.'.join([ i-3<0 and str(n)[:i] or str(n)[i-3:i] for i in range(len(str(n))%3, len(str(n))+1, 3) if i ]))

#####################################################################

## uitaskbar.py

## arat

self.SetWindowName("TaskBar")

## altýna ekle

		if app.ENABLE_ITEM_SHOP_SYSTEM:
			self.interface = None


## arat 

def __RampageGauge_OverIn(self):

## üstüne ekle

	if app.ENABLE_ITEM_SHOP_SYSTEM:
		def BindInterface(self, interface):
			self.interface = interface

## arat

def __RampageGauge_Click(self):

## tüm fonksiyonu deðiþtir

	def __RampageGauge_Click(self):
		if (constInfo.NEW_INGAME_SHOP == 1):
			if self.interface:
				self.interface.OpenItemShop()
		else:
			print "rampage_up"
			net.SendChatPacket("/in_game_mall")


###################################################################

## constInfo.py

## müsait biryere ekle

ITEM_DATA = {}
ITEM_SEARCH_DATA = []
NEW_INGAME_SHOP=1
