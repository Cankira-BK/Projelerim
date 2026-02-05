// arat 


#ifdef ENABLE_COSTUME_SYSTEM
	PyModule_AddIntConstant(poModule, "ENABLE_COSTUME_SYSTEM",	1);
#else
	PyModule_AddIntConstant(poModule, "ENABLE_COSTUME_SYSTEM",	0);
#endif


// altýna ekle

#ifdef ENABLE_ITEM_SHOP_SYSTEM
	PyModule_AddIntConstant(poModule, "ENABLE_ITEM_SHOP_SYSTEM", 1);
#else
	PyModule_AddIntConstant(poModule, "ENABLE_ITEM_SHOP_SYSTEM", 0);
#endif