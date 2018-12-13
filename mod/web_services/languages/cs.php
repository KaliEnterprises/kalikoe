<?php
return array(
	'APIException:ApiResultUnknown' => "Návratový kód API je neznámého typu, to by se nemělo nikdy stát.",
	'APIException:MissingParameterInMethod' => "Postrádám parametr %s v metodě %s",
	'APIException:ParameterNotArray' => "%s se nezdá býti polem.",
	'APIException:UnrecognisedTypeCast' => "Nerozpoznaný typ v přetypování %s pro proměnnou '%s' v metodě '%s'",
	'APIException:InvalidParameter' => "Nalezen neplatný parametr pro '%s' v metodě '%s'.",
	'APIException:FunctionParseError' => "%s(%s) má chybu v rozboru.",
	'APIException:FunctionNoReturn' => "%s(%s) vrátilo prázdnou hodnotu.",
	'APIException:APIAuthenticationFailed' => "Volání metody selhalo v ověřovacím API",
	'APIException:UserAuthenticationFailed' => "Volání metody selhalo při ověřování uživatele",
	'APIException:MethodCallNotImplemented' => "Volání metody '%s' nebylo implementováno.",
	'APIException:FunctionDoesNotExist' => "Funkce pro metou '%s' není volatelná.",
	'APIException:AlgorithmNotSupported' => "Algoritmus '%s' není podporován nebo byl zakázán.",
	'APIException:NotGetOrPost' => "Metoda požadavku musí být GET nebo POST",
	'APIException:MissingAPIKey' => "Chybí klíč API",
	'APIException:BadAPIKey' => "Špatný klíč API",
	'APIException:MissingHmac' => "Chybí hlavička X-Elgg-hmac",
	'APIException:MissingHmacAlgo' => "Chybí hlavička X-Elgg-hmac-algo",
	'APIException:MissingTime' => "Chybí hlavička X-Elgg-time",
	'APIException:MissingNonce' => "Chybí hlavička X-Elgg-nonce",
	'APIException:TemporalDrift' => "X-Elgg-time je příliš daleko v minulosti nebo budoucnosti. Období selhalo.",
	'APIException:NoQueryString' => "Žádná data v řetězci dotazu",
	'APIException:MissingPOSTHash' => "Chybí hlavička X-Elgg-posthash",
	'APIException:MissingPOSTAlgo' => "Chybí hlavička X-Elgg-posthash_algo",
	'APIException:MissingContentType' => "Chybí typ obsahu POSTových dat",
	'SecurityException:APIAccessDenied' => "Přístup k API byl bohužel zakázán správcem systému.",
	'SecurityException:NoAuthMethods' => "Nebyly nalezeny žádné ověřovací metody, které by mohly ověřit tento API požadavek.",
	'SecurityException:authenticationfailed' => "Uživatel nemohl být ověřen",
	'InvalidParameterException:APIMethodOrFunctionNotSet' => "Metoda nebo funkce není nastavena na volání v expose_method()",
	'InvalidParameterException:APIParametersArrayStructure' => "Struktura pole parametrů je pro volání expose_method nesprávná '%s'",
	'InvalidParameterException:UnrecognisedHttpMethod' => "Nerozpoznaná http metoda %s pro API metodu '%s'",
	'SecurityException:AuthTokenExpired' => "Ověřovací řetězec buď chybí, je neplatný nebo mu skončila platnost.",
	'SecurityException:InvalidPostHash' => "POST data mají neplatný hash - očekávám %s ale dostal jsem %s.",
	'SecurityException:DupePacket' => "Podpis balíčku byl již prohlédnut.",
	'SecurityException:InvalidAPIKey' => "Vadný nebo chybějící klíč API.",
	'NotImplementedException:CallMethodNotImplemented' => "Volání metody '%s' není aktuálně podporováno.",
	'CallException:InvalidCallMethod' => "%s musí být voláno použitím '%s'",

	'system.api.list' => "Vypíše všechna volání API, která jsou na tomto systému dostupná.",
	'auth.gettoken' => "Toto volání API umožňuje uživateli získat ověřovací řetězec, který může být použit pro ověření budoucích volání API. Předává se jako parametr auth_token",
);