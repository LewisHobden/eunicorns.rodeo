<?php

namespace App\Enum;

enum DiscordPermissionEnum : int
{
    // Admin
    case ADMINISTRATOR = 0x00000008;
    case BAN_MEMBERS = 0x00000004;
    case KICK_MEMBERS = 0x00000002;
    case MANAGE_CHANNELS = 0x00000010;
    case MANAGE_GUILD = 0x00000020;
    case MANAGE_MESSAGES = 0x00002000;
    case MANAGE_NICKNAMES = 0x08000000;
    case MANAGE_ROLES = 0x10000000;
    case MANAGE_WEBHOOKS = 0x20000000;
    case MANAGE_EMOJIS = 0x40000000;
    case MENTION_EVERYONE = 0x00020000;
    case USE_EXTERNAL_EMOJIS = 0x00040000;
    case VIEW_AUDIT_LOG = 0x00000080;

    // Regular
    case ADD_REACTIONS = 0x00000040;
    case ATTACH_FILES = 0x00008000;
    case CHANGE_NICKNAME = 0x04000000;
    case CREATE_INSTANT_INVITE = 0x00000001;
    case EMBED_LINKS = 0x00004000;
    case READ_MESSAGE_HISTORY = 0x00010000;
    case SEND_MESSAGES = 0x00000800;
    case SEND_TTS_MESSAGES = 0x00001000;
    case VIEW_CHANNEL = 0x00000400;

    // Voice
    case CONNECT = 0x00100000;
    case DEAFEN_MEMBERS = 0x00800000;
    case MOVE_MEMBERS = 0x01000000;
    case MUTE_MEMBERS = 0x00400000;
    case PRIORITY_SPEAKER = 0x00000100;
    case SPEAK = 0x00200000;
    case USE_VAD = 0x02000000;
}

