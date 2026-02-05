// arat

	else if (!strcmpi(szCmd, "BettingMoney"))
	{
		if (2 != TokenVector.size())
		{
			TraceError("CPythonNetworkStream::ServerCommand(c_szCommand=%s) - Strange Parameter Count : %s", c_szCommand);
			return;
		}

		//UINT uMoney= atoi(TokenVector[1].c_str());

	}

// kod blok bitiminden sonra altýna ekle (Kod parantez bitiþinden sonra)


#ifdef ENABLE_ITEM_SHOP_SYSTEM
	else if (!strcmpi(szCmd, "RefreshDragonCoin"))
	{
		if (2 != TokenVector.size())
		{
			TraceError("CPythonNetworkStream::ServerCommand(c_szCommand=%s) - Strange Parameter Count : %s", c_szCommand);
			return;
		}

		UINT dragoncoin = atoi(TokenVector[1].c_str());

		IAbstractPlayer& rkPlayer = IAbstractPlayer::GetSingleton();
		rkPlayer.SetDragonCoin(dragoncoin);
		PyCallClassMemberFunc(m_apoPhaseWnd[PHASE_WINDOW_GAME], "RefreshStatus", Py_BuildValue("()"));
	}
	else if (!strcmpi(szCmd, "RefreshDragonMark"))
	{
		if (2 != TokenVector.size())
		{
			TraceError("CPythonNetworkStream::ServerCommand(c_szCommand=%s) - Strange Parameter Count : %s", c_szCommand);
			return;
		}

		UINT dragonmark = atoi(TokenVector[1].c_str());

		IAbstractPlayer& rkPlayer = IAbstractPlayer::GetSingleton();
		rkPlayer.SetDragonMark(dragonmark);
		PyCallClassMemberFunc(m_apoPhaseWnd[PHASE_WINDOW_GAME], "RefreshStatus", Py_BuildValue("()"));
	}
#endif