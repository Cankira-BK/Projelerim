// arat

PyObject* playerSendDragonSoulRefine(PyObject* poSelf, PyObject* poArgs)

// üstüne ekle


#ifdef ENABLE_ITEM_SHOP_SYSTEM
PyObject* playerGetDragonCoin(PyObject* poSelf, PyObject* poArgs)
{
	return Py_BuildValue("i", CPythonPlayer::Instance().GetDragonCoin());
}

PyObject* playerGetDragonMark(PyObject* poSelf, PyObject* poArgs)
{
	return Py_BuildValue("i", CPythonPlayer::Instance().GetDragonMark());
}
#endif



// arat

		{ "GetLevel", playerGetLevel, METH_VARARGS },

// altýna ekle


#ifdef ENABLE_ITEM_SHOP_SYSTEM
		{"GetDragonCoin", playerGetDragonCoin, METH_VARARGS},
		{"GetDragonMark", playerGetDragonMark, METH_VARARGS},
#endif