<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
    @page { margin: 0; }
    body { font-family: Helvetica, Arial, sans-serif; font-size: 11pt; margin: 0; }
    .abs { position: absolute; }
    .micr { font-family: monospace; font-size: 14pt; letter-spacing: 2px; }
</style>
</head>
<body>
    <div class="abs" style="left:30px; top:20px;"><strong>{{ $payer['name'] }}</strong><br>{!! nl2br(e($payer['address'])) !!}</div>
    <div class="abs" style="left:30px; top:20px; width:552px; text-align:center;">{{ $bank['name'] }}</div>
    <div class="abs" style="right:30px; top:20px;">{{ $check->checkNumber }}</div>
    <div class="abs" style="right:30px; top:50px;">Date: {{ $date }}</div>
    <div class="abs" style="left:30px; top:90px;">Pay to the order of: <strong>{{ $check->payee }}</strong></div>
    <div class="abs" style="right:30px; top:90px; border:1px solid #000; padding:2px 8px;">${{ $amountFormatted }}</div>
    <div class="abs" style="left:30px; top:120px; border-bottom:1px solid #000; width:552px;">{{ $amountWords }}</div>
    <div class="abs" style="left:30px; top:175px;">Memo: {{ $check->memo }}</div>
    <div class="abs" style="right:30px; top:190px; width:200px; border-top:1px solid #000; text-align:center;">Authorized Signature</div>
    <div class="abs micr" style="left:40px; top:222px;">C{{ $check->checkNumber }}C A{{ $bank['routing_number'] }}A {{ $bank['account_number'] }}C</div>
</body>
</html>
