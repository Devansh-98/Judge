from ibapi.wrapper import EWrapper
from ibapi.client import EClient
from ibapi.contract import *
from ibapi.order import Order
from ibapi.common import *
# from ibapi.connection import Connection

from IB_API.trader import *

from Strategies.show_positions import *
from Strategies.moving_average_strategy import *

import time
import datetime
import pytz
import pandas as pd
import os

def createDatabase():
    #PORTFOLIO Database
    cwd= os.getcwd()
    PortfolioColumns = ['Capital_used','Cash', 'Pnl', 'Portfolio_value', 'Positions_value', 'Returns', 'Starting_cash', 'Start_date']
    portfolio_db = pd.DataFrame(columns=PortfolioColumns)
    portfolio_db.to_csv(os.path.join(cwd,'database/portfolio_db.csv'), index=True,header = True)

    #Order Database
    OrderColumns =['OrderId','Submitted_date','ContId','Action','Total_quantity','Account','Status','Filled','Remaining']
    order_db = pd.DataFrame(columns=OrderColumns)
    order_db.to_csv(os.path.join(cwd,'database/order_db.csv'), index=True,header = True)

    #Trade Signal Database
    SignalColumns = ['sma','lma','signals','positions','run_once']
    signal_db = pd.DataFrame(columns=SignalColumns)
    signal_db['signals']=0
    signal_db['signals']=True
    signal_db.to_csv(os.path.join(cwd,'database/signal_db.csv'), index=True, header = True)

class TestWrapper(EWrapper):
    def __init__(self):
        EWrapper.__init__(self)

class TestClient(EClient):
    def __init__(self, wrapper):
        EClient.__init__(self, wrapper)

class TestApp(TestWrapper, TestClient):

    # context = None
    # data = None
    cwd = os.getcwd()
    stockList = pd.read_csv(os.path.join(cwd, 'database/contracts.csv'))

    sysTimeZone = pytz.timezone('Asia/Kolkata')

    def __init__(self,ipaddress, portid, clientid):
        TestWrapper.__init__(self)
        TestClient.__init__(self, wrapper=self)
        self.nextValidOrderId = 934
        self.connect(ipaddress, portid, clientid)

        # self.context = ContextClass(self.accountCode)
        # self.data = None

        self.showTimeZone = pytz.timezone('Asia/Kolkata')

    def retStockList(self):
        return self.stockList

    def error(self, reqId:TickerId, errorCode:int, errorString:str):
        print("Error: "," ",reqId," ",errorCode," ",errorString)


    def contractDetails(self, reqId:int, contractDetails:ContractDetails):
        print("Contract Details: ",reqId," ",contractDetails)


    def nextValidId(self, orderId: int):
        super().nextValidId(orderId)

        self.nextValidOrderId = orderId
        print("NextValidId:", orderId)

    def nextOrderId(self):
        oid = self.nextValidOrderId
        self.nextValidOrderId += 1
        return oid

    def currentTime(self, time:int):
        super().currentTime(time)
        print("CurrentTime:", datetime.datetime.fromtimestamp(time).strftime("%Y%m%d %H:%M:%S"))


def initialize():
    createDatabase()
    print("Database created")


def main():
    print("Running market connection")

    #TODO
    # disconnect=Connection('127.0.0.1',7497)
    # if ~disconnect.isConnected():
    #     disconnect.disconnect()
    #     print("disconnectedddddddd")

    app = TestApp("127.0.0.1",7497,999)
    print("serverVersion:%s connectionTime:%s" % (app.serverVersion(),
                                                  app.twsConnectionTime()))
    contracts = app.retStockList()
    # contracts =contracts.reset_index(drop=True)
    print(contracts.head())

    try:
        id(fileName)
    except:
        print (__name__+':EXIT, fileName is empty')
        exit()

    if r'\\' in fileName or r'/' in fileName:
        with open(fileName) as f:
            script = f.read()
        exec(script)
    else:
        with open(os.path.join(os.getcwd(), 'Strategies', fileName)) as f:
            script = f.read()
        exec(script)

    # app.reqContractDetails(67, contract)
    # print ('Contract details run')

    '''<Timer which will run daily at 1 min interval>'''
    # while True:
    strategy(app,stock,short_window,long_window)
        # time.sleep(20)


    app.run()
    app.disconnect()

if __name__ == "__main__":
    main()
