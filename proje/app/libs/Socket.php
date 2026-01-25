<?php

class SocketConnection 
{
      
    private $m_socket;
    private $m_recv_buf;
   
    public function __construct()
    {
        $this->m_socket = 0;
        $this->m_recv_buf = "";
    }

    public function Connect($host, $port, $timeout)
    {
        $this->m_socket = @fsockopen($host, $port, $errno, $errstr, $timeout);

        if (!$this->m_socket)
        {
            echo(sprintf("%s (%d)<br>\n", $errstr, $errno));
            return false;
        }


        return true;
    }

    public function Recv($len)
    {
        $this->m_recv_buf = @fread($this->m_socket, $len);
    }

    public function Send($buf)
    {
        @fwrite($this->m_socket, $buf);
    }
   
    public function GetRecvBuf()
    {
        return $this->m_recv_buf;
    }

}

class GameConnector
{
    private $m_socketConnector;

    public function __construct($host, $port)
    {
        $this->m_socketConnector = new SocketConnection;

        if (!$this->m_socketConnector->Connect($host, $port, 5))
            return false;

        $this->m_socketConnector->Recv(32);

        $recvBuf = $this->m_socketConnector->GetRecvBuf();
       
        if (ord($recvBuf[0]) != 253)
        {
            echo("GameConnector does not handle this packet!");
            return false;
        }
    }

    public function Send($str)
    {
        $this->m_socketConnector->Send("@".$str."\n");
        $this->m_socketConnector->Recv(64);
    }

    public function GetBuffer()
    {
        return $this->m_socketConnector->GetRecvBuf();
    }
   
}
?>