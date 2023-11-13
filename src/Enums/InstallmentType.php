<?php

namespace ValoremPay\Enums;

enum InstallmentType: int
{
    case WITH_CARD_ISSUER_INTEREST = 3;
    case STORE_WITHOUT_INTEREST = 4;
    case WITH_IATA_INTEREST = 6;
    case STORE_WITHOUT_INTEREST_IATA = 7;
}
