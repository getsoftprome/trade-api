<?php

namespace Payeer\Trade;

use Payeer\Request\Request;
use Payeer\Helpers\SignatureHelper;

class Trade
{
    private string $apiKey;
    private string $apiId;
    private Request $request;

    function __construct(string $apiKey = '', string $apiId = '')
    {
        $this->apiId = $apiId;
        $this->apiKey = $apiKey;
        $this->request = new Request(new SignatureHelper($apiKey, $apiId));
    }

    public function Time()
    {
        $res = $this->request->get('time');
        return $res;
    }

    public function Info(string $pair = '')
    {
        if ($pair === '') {
            $res = $this->request->get('info');
        } else {
            $options['pair'] = $pair;
            $res = $this->request->post('info', $options);
        }

        return $res;
    }

    public function Ticker(string $pair = '')
    {
        if ($pair === '') {
            $res = $this->request->get('ticker');
        } else {
            $options['pair'] = $pair;
            $res = $this->request->post('ticker', $options);
        }

        return $res;
    }

    public function Orders(string $pair)
    {
        $options['pair'] = $pair;
        $res = $this->request->post('ticker', $options);

        return $res;
    }

    public function Trades(string $pair)
    {
        $options['pair'] = $pair;
        $res = $this->request->post('ticker', $options);

        return $res;
    }

    public function Account()
    {
        $res = $this->request->post('account');
        return $res;
    }

    public function OrderCreateLimit(string $pair, string $action, $amount, $price)
    {
        $options['pair'] = $pair;
        $options['type'] = 'limit';
        $options['action'] = $action;
        $options['amount'] = $amount;
        $options['price'] = $price;

        $res = $this->request->post('order_create', $options);
        return $res;
    }

    public function OrderCreateMarket(string $pair, string $action, $value = 0, $amount = 0)
    {
        $options['pair'] = $pair;
        $options['type'] = 'market';
        $options['action'] = $action;

        if ($value === 0) {
            $options['amount'] = $amount;
        }
        {
            $options['value'] = $value;
        }

        $res = $this->request->post('order_create', $options);
        return $res;
    }

    public function OrderCreateStopLimit(string $pair, string $action, $amount, $price, $stopPrice)
    {
        $options['pair'] = $pair;
        $options['type'] = 'stop_limit';
        $options['action'] = $action;
        $options['amount'] = $amount;
        $options['price'] = $price;
        $options['stop_price'] = $stopPrice;

        $res = $this->request->post('order_create', $options);
        return $res;
    }

    public function OrderStatus(int $orderId)
    {
        $options['orderId'] = $orderId;
        $res = $this->request->post('order_status', $options);
        return $res;
    }

    public function OrderCancel($orderId = 0, string $pair = '', string $action = '')
    {
        $options = [];

        if ($orderId !== 0) {
            $options['orderId'] = $orderId;
        } else {
            if ($pair !== '') {
                $options['pair'] = $pair;
                if ($action !== '') {
                    $options['action'] = $action;
                }
            }
        }

        $res = $this->request->post('order_cancel', $options);
        return $res;
    }

    public function MyOrders(string $pair = '', string $action = '')
    {
        $options = [];

        if ($pair !== '') {
            $options['pair'] = $pair;
        }
        if ($action !== '') {
            $options['action'] = $action;
        }
        $res = $this->request->post('my_orders', $options);
        return $res;
    }

    public function MyHistory(string $pair = '', string $action = '', string $status = '', int $dateFrom = 0, int $dateTo = 0, int $append = 0,int $limit = 0)
    {
        $options = [];

        if ($pair !== '') {
            $options['pair'] = $pair;
        }
        if ($action !== '') {
            $options['action'] = $action;
        }
        if ($status !== '') {
            $options['status'] = $status;
        }
        if ($dateFrom !== 0) {
            $options['date_from'] = $dateFrom;
        }
        if ($dateTo !== 0) {
            $options['date_to'] = $dateTo;
        }
        if ($append !== 0) {
            $options['append'] = $append;
        }
        if ($limit !== 0) {
            $options['limit'] = $limit;
        }
        $res = $this->request->post('my_history', $options);
        return $res;
    }

    public function MyTrades(string $pair = '', string $action = '', int $dateFrom = 0, int $dateTo = 0, int $append = 0, int $limit = 0)
    {
        $options = [];

        if ($pair !== '') {
            $options['pair'] = $pair;
        }
        if ($action !== '') {
            $options['action'] = $action;
        }
        if ($dateFrom !== 0) {
            $options['date_from'] = $dateFrom;
        }
        if ($dateTo !== 0) {
            $options['date_to'] = $dateTo;
        }
        if ($append !== 0) {
            $options['append'] = $append;
        }
        if ($limit !== 0) {
            $options['limit'] = $limit;
        }
        $res = $this->request->post('my_trades', $options);
        return $res;
    }



}