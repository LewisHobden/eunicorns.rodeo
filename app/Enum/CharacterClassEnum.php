<?php

namespace App\Enum;

enum CharacterClassEnum: string
{
    case ARCANA = "arcana";
    case ARTILLERIST = "artillerist";
    case ARTIST = "artist";
    case BARD = "bard";
    case BERSERKER = "berserker";
    case DEADEYE = "deadeye";
    case DEATHBLADE = "deathblade";
    case DESTROYER = "destroyer";
    case GLAIVIER = "glaivier";
    case GUNLANCER = "gunlancer";
    case GUNSLINGER = "gunslinger";
    case PALADIN = "paladin";
    case REAPER = "reaper";
    case SCOUTER = "scouter";
    case SCRAPPER = "scrapper";
    case SHADOWHUNTER = "shadowhunter";
    case SHARPSHOOTER = "sharpshooter";
    case SORCERESS = "sorceress";
    case SOULFIST = "soulfist";
    case STRIKER = "striker";
    case SUMMONER = "summoner";
    case WARDANCER = "wardancer";

    use ToFriendlyTrait;
}
