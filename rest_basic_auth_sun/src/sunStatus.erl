-module(sunStatus).
-export([start/0, init/0,setStatus/2,getStatus/1,setPidLink/2,getPidLink/1,updateStatus/2]). 

start() ->
	register(ledStatus, spawn(?MODULE, init, [])).

updateStatus(Name , Data)-> 
	ets:update_element(logboeksunStatusDT, Name, {2, Data}).

setPidLink(Name,Data)-> 
	ets:insert(logboeksunStatusDT, {Name, Data}).

setStatus(Name,Data)-> 
	ets:insert(logboeksunStatusDT, {Name, Data}).

init() -> 
	ets:new(logboeksunStatusDT, [named_table, ordered_set, public]),	
	ets:insert(logboeksunStatusDT, {sun, notDefined}),	
	loop().

loop() -> 
	receive
		stop -> ok
end.

getStatus(Name) ->

	[{_,Value}] = ets:lookup(logboeksunStatusDT, Name),
	Value. 
getPidLink(Name) ->

	[{_,Value}] = ets:lookup(logboeksunStatusDT, Name),
	Value. 







