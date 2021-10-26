<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оплата и доставка");?><style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }


        .tabs {
            font-size: 0;
            max-width: 1170px;
            margin-left: auto;
            margin-right: auto;
        }

        .tabs>input[type="radio"] {
            display: none;
        }

        .tabs>div {
            /* скрыть контент по умолчанию */
            display: none;
            border: 1px solid #e0e0e0;
            border-top: none;
            padding: 10px 15px;
            font-size: 16px;
            background-color: #f5f5f5;
        }

        /* отобразить контент, связанный с вабранной радиокнопкой (input type="radio") */
        #tab-btn-1:checked~#content-1,
        #tab-btn-2:checked~#content-2,
        #tab-btn-3:checked~#content-3 {
            display: block;
        }

        .tabs>label {
            display: inline-block;
            text-align: center;
            vertical-align: middle;
            user-select: none;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            font-size: 16px;
            line-height: 1.5;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out;
            cursor: pointer;
            position: relative;
            top: 1px;
            width: 50%;
            padding: 10px;
        }

        .tabs>label:not(:first-of-type) {
            border-left: none;
            width: 50%;
            padding: 10px;
        }

        .tabs>input[type="radio"]:checked+label {
            background-color: #f5f5f5;
            border-bottom: 0;
            width: 50%;
            padding: 10px;
        }

        @media (max-width: 766px) {
            table.payment_methods td img {
                height: 40px;
            }
        }
        table.payment_methods td {
            font-size: 16px;
            font-weight: 500;
            vertical-align: middle;
            padding-left: 10px;
        }

        @media (min-width: 1200px){
            table.payment_methods {
                margin: auto;
                text-decoration: underline;
                margin-bottom: 50px;
            }
            table.payment_methods td img {
                padding: 23px;
                width: 100px;
            }
            table.payment_methods td {
                font-size: 16px;
                font-weight: 500;
                vertical-align: middle;
            }
            div.payment_texts {
                margin: auto;
                margin-bottom: 50px;
                padding-left: 100px;
                padding-right: 100px;
                font-weight: 300;
            }
        }


    </style>
<div class="tabs">
 <input type="radio" name="tab-btn" id="tab-btn-1" value="" checked=""> <label for="tab-btn-1">ОПЛАТА</label> <input type="radio" name="tab-btn" id="tab-btn-2" value=""> <label for="tab-btn-2">ДОСТАВКА</label>
	<div id="content-1">
		<table class="payment_methods">
		<tbody>
		<tr>
			<td>
 <img src="/images/coins.svg">
			</td>
			<td>
				 Оплата наличными при самовывозе из шоурума
			</td>
		</tr>
		<tr>
			<td>
 <img src="/images/card.svg">
			</td>
			<td>
				 Оплата картой (в том числе NFC) в шоуруме компании
			</td>
		</tr>
		<tr>
			<td>
 <img src="/images/card_sber.svg">
			</td>
			<td>
				 Оплата на карту Сбербанка
			</td>
		</tr>
		<tr>
			<td>
 <img src="/images/contract_payment.svg">
			</td>
			<td>
				 Безналичная оплата для юридических лиц
			</td>
		</tr>
		<tr>
			<td>
 <img src="/images/online_payment2.svg">
			</td>
			<td>
				 Онлайн оплата картой или PayPal при заказе на сайте
			</td>
		</tr>
		</tbody>
		</table>
		<div class="payment_texts">
 <b>Оплата наличными при самовывозе из шоурума</b> <br>
			 Заказ оплачивается в офисе компании.
			<p>
 <b>Оплата картой (в том числе NFC) в шоуруме компании</b> <br>
				 Доступна оплата картами VISA Inc, MasterCard WorldWide, МИР. При оформлении заказа в шоуруме компании и оплате его банковской картой (в том числе NFC) комиссия не взымается.
			</p>
			<p>
 <b>Оплата на карту Сбербанка</b> <br>
				 Заказ оплачивается путем перевода денежных средств на карту Сбербанка. После оплаты необходимо сообщить ФИО и сумму платежа через обратную связь или по телефонам: +7 495 777 91 55 или 8 800 222 00 42 (звонок по России бесплатный)
			</p>
			<p>
 <b>Безналичная оплата для юридических лиц</b> <br>
				 На основании заказа формируется счет на оплату, который необходимо оплатить в течение трех дней.
			</p>
			<p>
 <b>Онлайн оплата картой на сайте</b> <br>
				 Доступна оплата картами VISA Inc, MasterCard WorldWide. Обращаем Ваше внимание, что за оформление заказа при оплате банковской картой взимается сервисный сбор.
			</p>
			<p>
 <b>Правила оплаты банковскими картами ISA Inc, MasterCard WorldWide:</b> <br>
				 К оплате принимаются платежные карты: VISA Inc, MasterCard WorldWide. В случае если Вы по какой-то причине решили отменить свой заказ, за обратный перевод списанных денежных средств на Вашу карту сервисный сбор не возвращается. Сумма будет зачислена на Ваш счет в течение трех рабочих дней. Если заказ был отменен с нашей стороны (например, товар отсутствует на складе, что маловероятно), сумма, списанная с карты в счет оплаты заказа, будет возвращена на Ваш счет без каких-либо удержаний. Возврат суммы, уплаченной за заказ, возможен только на счет банковской карты, с которого была произведена оплата.
			</p>
			<p>
				 При оплате заказа банковской картой, обработка платежа происходит на авторизационной странице банка, где Вам необходимо ввести данные Вашей банковской карты: <br>
				 &gt; тип карты <br>
				 &gt; номер карты <br>
				 &gt; срок действия карты (указан на лицевой стороне карты) <br>
				 &gt; имя держателя карты (латинскими буквами, точно также как указано на карте) <br>
				 &gt; CVC2/CVV2 код
			</p>
			<p>
				 Если Ваша карта подключена к услуге 3D-Secure, Вы будете автоматически переадресованы на страницу банка, выпустившего карту, для прохождения процедуры аутентификации. Информацию о правилах и методах дополнительной идентификации уточняйте в Банке, выдавшем Вам банковскую карту. Безопасность обработки интернет-платежей через платежный шлюз банка гарантирована международным сертификатом безопасности PCI DSS. Передача информации происходит с применением технологии шифрования SSL. Эта информация недоступна посторонним лицам.
			</p>
			<p>
				 Советы и рекомендации по необходимым мерам безопасности проведения платежей с использованием банковской карты: <br>
				 &gt; берегите свои пластиковые карты так же, как бережете наличные деньги. Не забывайте их в машине, ресторане, магазине и т.д. <br>
				 &gt; никогда не передавайте полный номер своей кредитной карты по телефону каким-либо лицам или компаниям <br>
				 &gt; всегда имейте под рукой номер телефона для экстренной связи с банком, выпустившим вашу карту, и в случае ее утраты немедленно свяжитесь с банком <br>
				 &gt; вводите реквизиты карты только при совершении покупки. Никогда не указывайте их по каким-то другим причинам.
			</p>
		</div>
	</div>
	<div id="content-2">
		<table class="payment_methods">
		<tbody>
		<tr>
			<td>
 <img src="/images/pickup3.svg">
			</td>
			<td>
				 Самовывоз
			</td>
		</tr>
		<tr>
			<td>
 <img src="/images/deliver.svg">
			</td>
			<td>
				 Доставка курьером по Москве
			</td>
		</tr>
		<tr>
			<td>
 <img src="/images/express.svg">
			</td>
			<td>
				 Экспресс-доставка
			</td>
		</tr>
		<tr>
			<td>
 <img src="/images/fura.svg" style="height: 70px;">
			</td>
			<td>
				 Транспортные компании
			</td>
		</tr>
		</tbody>
		</table>
		<div class="payment_texts">
			<p>
 <b>Самовывоз</b> <br>
				 Вы можете оплатить и самостоятельно забрать свой заказ по адресу: <br>
				 107553, Москва, ул.Большая Черкизовская, 26АС1, офис 19.
			</p>
			<p>
 <b>Доставка курьером по Москве</b> <br>
				 Доставка курьером выполняется с понедельника по пятницу в пределах МКАД. <br>
				 Cтоимость и сроки уточняются у менеджера.
			</p>
			<p>
 <b>Экспресс-доставка</b> <br>
				 Экспресс доставка выполняется с понедельника по субботу в пределах МКАД. <br>
				 Доставка за МКАД осуществляется в пределах 1 километра от метро. <br>
				 Стоимость доставки 1000 рублей. Ограничение по весу заказа - 15кг. <br>
				 Экспресс-доставка доступна при оформлении заказа на сайте до 17:00.
			</p>
			<p>
 <b>Транспортные компании</b> <br>
				 Доставка транспортной компанией выполняется с понедельника по субботу. <br>
				 Все детали уточняются на странице оформления заказа.
			</p>
			<p>
				 Если вы хотите узнать номер транспортной накладной, напишите нам через обратную связь или позвоните по телефонам: <br>
				 +7 495 777 91 55 <br>
				 8 800 222 00 42 (звонок по России бесплатный) <br>
				 На сайте перевозчика, с помощью номера транспортной накладной, можно отслеживать местоположение груза в пути.
			</p>
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>