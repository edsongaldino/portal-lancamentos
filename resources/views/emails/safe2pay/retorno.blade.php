<p>ID da Transação: {{ $json->IdTransaction }}</p>
<p>Status: {{ $json->TransactionStatus->Name }}</p>
<p>Método de Pagamento: {{ $json->PaymentMethod->Name }}</p>
<p>Valor: {{ $json->Amount }}</p>