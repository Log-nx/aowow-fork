<?php

if (!defined('AOWOW_REVISION'))
    die('illegal access');


class Game
{
    public static $resistanceFields         = array(
        null,           'resHoly',      'resFire',      'resNature',    'resFrost',     'resShadow',    'resArcane'
    );

    public static $rarityColorStings        = array(        // zero-indexed
        '9d9d9d',       'ffffff',       '1eff00',       '0070dd',       'a335ee',       'ff8000',       'e5cc80',       'e6cc80'
    );

    public static $specIconStrings          = array(
        -1 =>  'inv_misc_questionmark',
         0 =>  'spell_nature_elementalabsorption',
         6 => ['spell_deathknight_bloodpresence', 'spell_deathknight_frostpresence', 'spell_deathknight_unholypresence' ],
        11 => ['spell_nature_starfall',           'ability_racial_bearform',         'spell_nature_healingtouch'        ],
         3 => ['ability_hunter_beasttaming',      'ability_marksmanship',            'ability_hunter_swiftstrike'       ],
         8 => ['spell_holy_magicalsentry',        'spell_fire_firebolt02',           'spell_frost_frostbolt02'          ],
         2 => ['spell_holy_holybolt',             'spell_holy_devotionaura',         'spell_holy_auraoflight'           ],
         5 => ['spell_holy_wordfortitude',        'spell_holy_holybolt',             'spell_shadow_shadowwordpain'      ],
         4 => ['ability_rogue_eviscerate',        'ability_backstab',                'ability_stealth'                  ],
         7 => ['spell_nature_lightning',          'spell_nature_lightningshield',    'spell_nature_magicimmunity'       ],
         9 => ['spell_shadow_deathcoil',          'spell_shadow_metamorphosis',      'spell_shadow_rainoffire'          ],
         1 => ['ability_rogue_eviscerate',        'ability_warrior_innerrage',       'ability_warrior_defensivestance'  ]
    );

    public static $classFileStrings         = array(
        null,   'warrior', 'paladin', 'hunter', 'rogue', 'priest', 'deathknight', 'shaman', 'mage', 'warlock', null, 'druid'
    );

    public static $questClasses             = array(
        -2 =>  [    0],
         0 =>  [    1,     3,     4,     8,     9,    10,    11,    12,    25,    28,    33,    36,    38,    40,    41,    44,    45,    46,    47,    51,    85,   130,   132,   139,   154,   267,  1497,  1519,  1537,  2257,  3430,  3431,  3433,  3487,  4080,  4298],
         1 =>  [   14,    15,    16,    17,   141,   148,   188,   215,   220,   331,   357,   361,   363,   400,   405,   406,   440,   490,   493,   618,  1377,  1637,  1638,  1657,  1769,  3524,  3525,  3526,  3557],
         2 =>  [  206,   209,   491,   717,   718,   719,   721,   722,   796,  1176,  1196,  1337,  1477,  1581,  1583,  1584,  1941,  2017,  2057,  2100,  2366,  2367,  2437,  2557,  3535,  3562,  3688,  3713,  3714,  3715,  3716,  3717,  3789,  3790,  3791,  3792,  3842,  3847,  3848,  3849,  3905,  4100,  4131,  4196,  4228,  4264,  4265,  4272,  4277,  4415,  4416,  4494,  4522,  4723,  4809,  4813,  4820],
         3 =>  [ 1977,  2159,  2677,  2717,  3428,  3429,  3456,  3457,  3606,  3607,  3805,  3836,  3845,  3923,  3959,  4075,  4273,  4493,  4500,  4603,  4722,  4812,  4987],
         4 =>  [ -372,  -263,  -262,  -261,  -162,  -161,  -141,   -82,   -81,   -61],
         5 =>  [ -373,  -371,  -324,  -304,  -264,  -201,  -182,  -181,  -121,  -101,   -24],
         6 =>  [  -25,  2597,  3277,  3358,  3820,  4384,  4710],
         7 =>  [-1010,  -368,  -367,  -365,  -344,  -241,    -1],
         8 =>  [ 3483,  3518,  3519,  3520,  3521,  3522,  3523,  3679,  3703],
         9 =>  [-1005, -1003, -1002, -1001,  -376,  -375,  -374,  -370,  -369,  -366,  -364,   -41,   -22],  // 22: seasonal
        10 =>  [   65,    66,    67,   210,   394,   495,  2817,  3537,  3711,  4024,  4197,  4395,  4742]
    );

    // zoneorsort for quests need updating
    // partially points non-instanced area with identical name for instance quests
    public static $questSortFix             = array(
        -221 => 440,                                        // Treasure Map => Tanaris
        -284 => 0,                                          // Special => Misc (some quests get shuffled into seasonal)
        151  => 0,                                          // Designer Island => Misc
        22   => 0,                                          // Programmer Isle
        35   => 33,                                         // Booty Bay => Stranglethorn Vale
        131  => 132,                                        // Kharanos => Coldridge Valley
        24   => 9,                                          // Northshire Abbey => Northshire Valley
        279  => 36,                                         // Dalaran Crater => Alterac Mountains
        4342 => 4298,                                       // Acherus: The Ebon Hold => The Scarlet Enclave
        2079 => 15,                                         // Alcaz Island => Dustwallow Marsh
        1939 => 440,                                        // Abyssal Sands => Tanaris
        393  => 363,                                        // Darkspeer Strand => Valley of Trials
        702  => 141,                                        // Rut'theran Village => Teldrassil
        221  => 220,                                        // Camp Narache => Red Cloud Mesa
        1116 => 357,                                        // Feathermoon Stronghold => Feralas
        236  => 209,                                        // Shadowfang Keep
        4769 => 4742,                                       // Hrothgar's Landing => Hrothgar's Landing
        4613 => 4395,                                       // Dalaran City => Dalaran
        4522 => 210,                                        // Icecrown Citadell => Icecrown
        3896 => 3703,                                       // Aldor Rise => Shattrath City
        3696 => 3522,                                       // The Barrier Hills => Blade's Edge Mountains
        2839 => 2597,                                       // Alterac Valley
        19   => 1977,                                       // Zul'Gurub
        4445 => 4273,                                       // Ulduar
        2300 => 1941,                                       // Caverns of Time
        3545 => 3535,                                       // Hellfire Citadel
        2562 => 3457,                                       // Karazhan
        3840 => 3959,                                       // Black Temple
        1717 => 491,                                        // Razorfen Kraul
        978  => 1176,                                       // Zul'Farrak
        133  => 721,                                        // Gnomeregan
        3607 => 3905,                                       // Serpentshrine Cavern
        3845 => 3842,                                       // Tempest Keep
        1517 => 1337,                                       // Uldaman
        1417 => 1477                                        // Sunken Temple
    );

    public static $questSubCats             = array(
        1    => [132],                                      // Dun Morogh: Coldridge Valley
        12   => [9],                                        // Elwynn Forest: Northshire Valley
        141  => [188],                                      // Teldrassil: Shadowglen
        3524 => [3526],                                     // Azuremyst Isle: Ammen Vale

        14   => [363],                                      // Durotar: Valley of Trials
        85   => [154],                                      // Tirisfal Glades: Deathknell
        215  => [220],                                      // Mulgore: Red Cloud Mesa
        3430 => [3431],                                     // Eversong Woods: Sunstrider Isle

        46   => [25],                                       // Burning Steppes: Blackrock Mountain
        361  => [1769],                                     // Felwood: Timbermaw Hold
        3519 => [3679],                                     // Terokkar: Skettis
        3535 => [3562, 3713, 3714],                         // Hellfire Citadel
        3905 => [3715, 3716, 3717],                         // Coilfang Reservoir
        3688 => [3789, 3790, 3792],                         // Auchindoun
        1941 => [2366, 2367, 4100],                         // Caverns of Time
        3842 => [3847, 3848, 3849],                         // Tempest Keep
        4522 => [4809, 4813, 4820]                          // Icecrown Citadel
    );

    /*  why:
        Because petSkills (and ranged weapon skills) are the only ones with more than two skillLines attached. Because Left Joining ?_spell with ?_skillLineability  causes more trouble than it has uses.
        Because this is more or less the only reaonable way to fit all that information into one database field, so..
        .. the indizes of this array are bits of skillLine2OrMask in ?_spell if skillLineId1 is negative
    */
    public static $skillLineMask            = array(        // idx => [familyId, skillLineId]
        -1 => array(                                        // Pets (Hunter)
            [ 1, 208],          [ 2, 209],          [ 3, 203],          [ 4, 210],          [ 5, 211],          [ 6, 212],          [ 7, 213],  // Wolf,       Cat,          Spider,       Bear,        Boar,      Crocolisk,    Carrion Bird
            [ 8, 214],          [ 9, 215],          [11, 217],          [12, 218],          [20, 236],          [21, 251],          [24, 653],  // Crab,       Gorilla,      Raptor,       Tallstrider, Scorpid,   Turtle,       Bat
            [25, 654],          [26, 655],          [27, 656],          [30, 763],          [31, 767],          [32, 766],          [33, 765],  // Hyena,      Bird of Prey, Wind Serpent, Dragonhawk,  Ravager,   Warp Stalker, Sporebat
            [34, 764],          [35, 768],          [37, 775],          [38, 780],          [39, 781],          [41, 783],          [42, 784],  // Nether Ray, Serpent,      Moth,         Chimaera,    Devilsaur, Silithid,     Worm
            [43, 786],          [44, 785],          [45, 787],          [46, 788]                                                               // Rhino,      Wasp,         Core Hound,   Spirit Beast
        ),
        -2 => array(                                        // Pets (Warlock)
            [15, 189],          [16, 204],          [17, 205],          [19, 207],          [23, 188],          [29, 761]                       // Felhunter,  Voidwalker,   Succubus,     Doomguard,   Imp,       Felguard
        ),
        -3 => array(                                        // Ranged Weapons
            [null, 45],         [null, 46],         [null, 226]                                                                                 // Bow,         Gun,         Crossbow
        )
    );

    public static $sockets                  = array(        // jsStyle Strings
        'meta',                         'red',                          'yellow',                       'blue'
    );

    public static $class2SpellFamily        = array(
    //  null    Warrior Paladin Hunter  Rogue   Priest  DK      Shaman  Mage    Warlock null    Druid
        null,   4,      10,     9,      8,      6,      15,     11,     3,      5,      null,   7
    );

    public static function sideByRaceMask($race)
    {
        // Any
        if (!$race || ($race & RACE_MASK_ALL) == RACE_MASK_ALL)
            return SIDE_BOTH;

        // Horde
        if ($race & RACE_MASK_HORDE && !($race & RACE_MASK_ALLIANCE))
            return SIDE_HORDE;

        // Alliance
        if ($race & RACE_MASK_ALLIANCE && !($race & RACE_MASK_HORDE))
            return SIDE_ALLIANCE;

        return SIDE_BOTH;
    }

    public static function getReputationLevelForPoints($pts)
    {
        if ($pts >= 41999)
            return REP_EXALTED;
        else if ($pts >= 20999)
            return REP_REVERED;
        else if ($pts >= 8999)
            return REP_HONORED;
        else if ($pts >= 2999)
            return REP_FRIENDLY;
        else if ($pts >= 0)
            return REP_NEUTRAL;
        else if ($pts >= -3000)
            return REP_UNFRIENDLY;
        else if ($pts >= -6000)
            return REP_HOSTILE;
        else
            return REP_HATED;
    }

    public static function getTaughtSpells(&$spell)
    {
        $extraIds = [-1];                                    // init with -1 to prevent empty-array errors
        $lookup   = [-1];
        switch (gettype($spell))
        {
            case 'object':
                if (get_class($spell) != 'SpellList')
                    return [];

                $lookup[] = $spell->id;
                foreach ($spell->canTeachSpell() as $idx)
                    $extraIds[] = $spell->getField('effect'.$idx.'TriggerSpell');

                break;
            case 'integer':
                $lookup[] = $spell;
                break;
            case 'array':
                $lookup = $spell;
                break;
            default:
                return [];
        }

        // note: omits required spell and chance in skill_discovery_template
        $data = array_merge(
            DB::World()->selectCol('SELECT spellId FROM spell_learn_spell WHERE entry IN (?a)', $lookup),
            DB::World()->selectCol('SELECT spellId FROM skill_discovery_template WHERE reqSpell IN (?a)', $lookup),
            $extraIds
        );

        // return list of integers, not strings
        $data = array_map('intVal', $data);

        return $data;
    }

    public static function getPageText($ptId)
    {
        $pages = [];
        while ($ptId)
        {
            if ($row = DB::World()->selectRow('SELECT ptl.Text AS Text_loc?d, pt.* FROM page_text pt LEFT JOIN page_text_locale ptl ON pt.ID = ptl.ID AND locale = ? WHERE pt.ID = ?d', User::$localeId, User::$localeString, $ptId))
            {
                $ptId = $row['NextPageID'];
                $pages[] = Util::parseHtmlText(Util::localizedString($row, 'Text'));
            }
            else
            {
                trigger_error('Referenced PageTextId #'.$ptId.' is not in DB', E_USER_WARNING);
                break;
            }
        }

        return $pages;
    }


    /*********************/
    /* World Pos. Checks */
    /*********************/

    private static $alphaMapCache = [];

    private static function alphaMapCheck(int $areaId, array &$set) : bool
    {
        $file = 'cache/alphaMaps/'.$areaId.'.png';
        if (!file_exists($file))                            // file does not exist (probably instanced area)
            return false;

        // invalid and corner cases (literally)
        if (!is_array($set) || empty($set['posX']) || empty($set['posY']) || $set['posX'] >= 100 || $set['posY'] >= 100)
        {
            $set = null;
            return true;
        }

        if (empty(self::$alphaMapCache[$areaId]))
            self::$alphaMapCache[$areaId] = imagecreatefrompng($file);

        // alphaMaps are 1000 x 1000, adapt points [black => valid point]
        if (!imagecolorat(self::$alphaMapCache[$areaId], $set['posX'] * 10, $set['posY'] * 10))
            $set = null;

        return true;
    }

    public static function checkCoords(array $points) : array
    {
        $result   = [];
        $capitals = array(                                  // capitals take precedence over their surroundings
            1497, 1637, 1638, 3487,                         // Undercity,      Ogrimmar,  Thunder Bluff, Silvermoon City
            1519, 1537, 1657, 3557,                         // Stormwind City, Ironforge, Darnassus,     The Exodar
            3703, 4395                                      // Shattrath City, Dalaran
        );

        foreach ($points as $res)
        {
            if (self::alphaMapCheck($res['areaId'], $res))
            {
                if (!$res)
                    continue;

                // some rough measure how central the spawn is on the map (the lower the number, the better)
                // 0: perfect center; 1: touches a border
                $q = abs( (($res['posX'] - 50) / 50) * (($res['posY'] - 50) / 50) );

                if (empty($result) || $result[0] > $q)
                    $result = [$q, $res];
            }
            else if (in_array($res['areaId'], $capitals))   // capitals (auto-discovered) and no hand-made alphaMap available
                return $res;
            else if (empty($result))                        // add with lowest quality if alpha map is missing
                $result = [1.0, $res];
        }

        // spawn does not really match on a map, but we need at least one result
        if (!$result)
        {
            usort($points, function ($a, $b) { return ($a['dist'] < $b['dist']) ? -1 : 1; });
            $result = [1.0, $points[0]];
        }

        return $result[1];
    }

    public static function getWorldPosForGUID(int $type, int ...$guids) : array
    {
        $result = [];

        switch ($type)
        {
            case Type::NPC:
                $result = DB::World()->select('SELECT `guid` AS ARRAY_KEY,              `id`, `map`         AS `mapId`, `position_x` AS `posX`, `position_y` AS `posY` FROM creature        WHERE `guid` IN (?a)', $guids);
                break;
            case Type::OBJECT:
                $result = DB::World()->select('SELECT `guid` AS ARRAY_KEY,              `id`, `map`         AS `mapId`, `position_x` AS `posX`, `position_y` AS `posY` FROM gameobject      WHERE `guid` IN (?a)', $guids);
                break;
            case Type::SOUND:
                $result = DB::AoWoW()->select('SELECT `id`   AS ARRAY_KEY, `soundId` AS `id`,                  `mapId`,                 `posX`,                 `posY` FROM ?_soundemitters WHERE `id`   IN (?a)', $guids);
                break;
            case Type::ZONE:
                $result = DB::Aowow()->select('SELECT -`id`  AS ARRAY_KEY,              `id`, `parentMapId` AS `mapId`, `parentX`    AS `posX`, `parentY`    AS `posY` FROM ?_zones         WHERE -`id`  IN (?a)', $guids);
                break;
            case Type::AREATRIGGER:
                $result = [];
                if ($base = array_filter($guids, function ($x) { return $x > 0; }))
                    $result = array_replace($result, DB::AoWoW()->select('SELECT `id`   AS ARRAY_KEY,          `id`,          `mapId`,                 `posX`,                 `posY` FROM ?_areatrigger   WHERE `id`   IN (?a)', $base));
                if ($endpoints = array_filter($guids, function ($x) { return $x < 0; }))
                    $result = array_replace($result, DB::World()->select(
                       'SELECT -`ID`          AS ARRAY_KEY, ID          AS `id`,    `target_map` AS `mapId`, `target_position_x` AS `posX`, `target_position_y` AS `posY` FROM areatrigger_teleport WHERE -`id`          IN (?a) UNION
                        SELECT -`entryorguid` AS ARRAY_KEY, entryorguid AS `id`, `action_param1` AS `mapId`, `target_x`          AS `posX`, `target_y`          AS `posY` FROM smart_scripts        WHERE -`entryorguid` IN (?a) AND `source_type` = ?d AND `action_type` = ?d',
                        $endpoints, $endpoints, SAI_SRC_TYPE_AREATRIGGER, SAI_ACTION_TELEPORT
                     ));
                break;
            default:
                trigger_error('Game::getWorldPosForGUID - instanced with unsupported TYPE #'.$type, E_USER_WARNING);
        }

        if ($diff = array_diff($guids, array_keys($result)))
            trigger_error('Game::getWorldPosForGUID - no spawn points for TYPE #'.$type.' GUIDS: '.implode(', ', $diff), E_USER_WARNING);

        return $result;
    }

    public static function worldPosToZonePos(int $mapId, float $posX, float $posY, int $areaId = 0, int $floor = -1) : array
    {
        if (!$mapId < 0)
            return [];

        $query =
           'SELECT
                x.`id`,
                x.`areaId`,
                IF(x.`defaultDungeonMapId` < 0, x.`floor` + 1, x.`floor`) AS `floor`,
                IF(dm.`id` IS NOT NULL OR x.`defaultDungeonMapId` < 0, 1, 0) AS `multifloor`,
                ROUND((x.`maxY` - ?d) * 100 / (x.`maxY` - x.`minY`), 1) AS `posX`,
                ROUND((x.`maxX` - ?d) * 100 / (x.`maxX` - x.`minX`), 1) AS `posY`,
                SQRT(POWER(ABS((x.`maxY` - ?d) * 100 / (x.`maxY` - x.`minY`) - 50), 2) +
                     POWER(ABS((x.`maxX` - ?d) * 100 / (x.`maxX` - x.`minX`) - 50), 2)) AS `dist`
            FROM
                (SELECT 0 AS `id`, `areaId`,     `mapId`, `right` AS `minY`, `left` AS `maxY`, `top` AS `maxX`, `bottom` AS `minX`, 0 AS `floor`, 0 AS `worldMapAreaId`, `defaultDungeonMapId` FROM ?_worldmaparea wma
                 WHERE `mapId` IN (0, 1, 530, 571, 603, 580, 564, 595) UNION   -- select only for continents or maps that use wma data as floor 0
                 SELECT   dm.`id`, `areaId`, wma.`mapId`,            `minY`,           `maxY`,          `maxX`,             `minX`,      `floor`,      `worldMapAreaId`, `defaultDungeonMapId` FROM ?_worldmaparea wma
                 JOIN   ?_dungeonmap dm ON dm.`mapId` = wma.`mapId` WHERE wma.`mapId` NOT IN (0, 1, 530, 571) OR wma.`areaId` = 4395) x
            LEFT JOIN
                ?_dungeonmap dm ON dm.`mapId` = x.`mapId` AND dm.`worldMapAreaId` = x.`worldMapAreaId` AND dm.`floor` <> x.`floor` AND dm.`worldMapAreaId` > 0
            WHERE
                x.`mapId` = ?d AND IF(?d, x.`areaId` = ?d, x.`areaId` <> 0){ AND x.`floor` = ?d - IF(x.`defaultDungeonMapId` < 0, 1, 0)}
            GROUP BY
                x.`id`, x.`areaId`
            HAVING
                (`posX` BETWEEN 0.1 AND 99.9 AND `posY` BETWEEN 0.1 AND 99.9)
            ORDER BY
                `multifloor` DESC, `dist` ASC';

        // dist BETWEEN 0 (center) AND 70.7 (corner)
        $points = DB::Aowow()->select($query, $posY, $posX, $posY, $posX, $mapId, $areaId, $areaId, $floor < 0 ? DBSIMPLE_SKIP : $floor);
        if (!$points)                                       // retry: pre-instance subareas belong to the instance-maps but are displayed on the outside. There also cases where the zone reaches outside it's own map.
            $points = DB::Aowow()->select($query, $posY, $posX, $posY, $posX, $mapId, 0, 0, DBSIMPLE_SKIP);
        if (!is_array($points))
        {
            trigger_error('Game::worldPosToZonePos - dbc query failed', E_USER_ERROR);
            return [];
        }

        return $points;
    }

    public static function getQuotesForCreature(int $creatureId, bool $asHTML = false, string $talkSource = '') : array
    {
        $nQuotes  = 0;
        $quotes   = [];
        $soundIds = [];

        $quoteSrc = DB::World()->select('
            SELECT
                ct.GroupID AS ARRAY_KEY, ct.ID as ARRAY_KEY2,
                ct.`Type` AS `talkType`,
                ct.TextRange AS `range`,
                IFNULL(bct.`LanguageID`, ct.`Language`) AS lang,
                IFNULL(NULLIF(bct.Text, ""), IFNULL(NULLIF(bct.Text1, ""), IFNULL(ct.`Text`, ""))) AS text_loc0,
               {IFNULL(NULLIF(bctl.Text, ""), IFNULL(NULLIF(bctl.Text1, ""), IFNULL(ctl.Text, ""))) AS text_loc?d,}
                IF(bct.SoundEntriesID > 0, bct.SoundEntriesID, ct.Sound) AS soundId
            FROM
                creature_text ct
           {LEFT JOIN
                creature_text_locale ctl ON ct.CreatureID = ctl.CreatureID AND ct.GroupID = ctl.GroupID AND ct.ID = ctl.ID AND ctl.Locale = ?}
            LEFT JOIN
                broadcast_text bct ON ct.BroadcastTextId = bct.ID
           {LEFT JOIN
                broadcast_text_locale bctl ON ct.BroadcastTextId = bctl.ID AND bctl.locale = ?}
            WHERE
                ct.CreatureID = ?d',
            User::$localeId ?: DBSIMPLE_SKIP,
            User::$localeId ? Util::$localeStrings[User::$localeId] : DBSIMPLE_SKIP,
            User::$localeId ? Util::$localeStrings[User::$localeId] : DBSIMPLE_SKIP,
            $creatureId
        );

        foreach ($quoteSrc as $grp => $text)
        {
            $group = [];
            foreach ($text as $t)
            {
                if ($t['soundId'])
                    $soundIds[] = $t['soundId'];

                $msg = Util::localizedString($t, 'text');
                if (!$msg)
                    continue;

                // fixup .. either set %s for emotes or dont >.<
                if (in_array($t['talkType'], [2, 16]) && strpos($msg, '%s') === false)
                    $msg = '%s '.$msg;

                // fixup: bad case-insensivity
                $msg = Util::parseHtmlText(str_replace('%S', '%s', htmlentities($msg)), !$asHTML);

                if ($talkSource)
                    $msg = sprintf($msg, $talkSource);

                // make type css compatible
                switch ($t['talkType'])
                {
                    case  1:                                // yell:
                    case 14: $t['talkType'] = 1; break;     // - dark red
                    case  2:                                // emote:
                    case 16:                                // "
                    case  3:                                // boss emote:
                    case 41: $t['talkType'] = 4; break;     // - orange
                    case  4:                                // whisper:
                    case 15:                                // "
                    case  5:                                // boss whisper:
                    case 42: $t['talkType'] = 3; break;     // - pink-ish
                    default: $t['talkType'] = 2;            // [type: 0, 12] say: yellow-ish

                }

                // prefix
                $pre = '';
                if ($t['talkType'] != 4)
                    $pre = ($talkSource ?: '%s').' '.Lang::npc('textTypes', $t['talkType']).Lang::main('colon').($t['lang'] ? '['.Lang::game('languages', $t['lang']).'] ' : null);

                if ($asHTML)
                    $msg = '<div><span class="s'.$t['talkType'].'">%s'.($t['range'] ? sprintf(Util::$dfnString, Lang::npc('textRanges', $t['range']), $msg) : $msg).'</span></div>';
                else
                    $msg = '[div][span class=s'.$t['talkType'].']%s'.html_entity_decode($msg).'[/span][/div]';

                $line = array(
                    'range'  => $t['range'],
                    'text'   => $msg,
                    'prefix' => $pre
                );


                $nQuotes++;
                $group[] = $line;
            }

            if ($group)
                $quotes[$grp] = $group;
        }

        return [$quotes, $nQuotes, $soundIds];
    }

    public static function getBreakpointsForSkill(int $skillId, int $reqLevel) : array
    {
        if ($skillId == SKILL_FISHING)
            return array(
                round(sqrt(.25) * $reqLevel),               //  25% valid catches
                round(sqrt(.50) * $reqLevel),               //  50% valid catches
                round(sqrt(.75) * $reqLevel),               //  75% valid catches
                $reqLevel                                   // 100% valid catches
            );

        switch ($skillId)
        {
            case SKILL_SKINNING:
                if ($reqLevel < 10)
                    $reqLevel = 0;
                else if ($reqLevel < 20)
                    $reqLevel = ($reqLevel - 10) * 10;
                else
                    $reqLevel *= 5;
            case SKILL_HERBALISM:
            case SKILL_LOCKPICKING:
            case SKILL_JEWELCRAFTING:
            case SKILL_INSCRIPTION:
            case SKILL_MINING:
                $points = [$reqLevel];                              // red/orange

                if ($reqLevel + 25 <= MAX_SKILL)                    // orange/yellow
                    $points[] = $reqLevel + 25;

                if ($reqLevel + 50 <= MAX_SKILL)                    // yellow/green
                    $points[] = $reqLevel + 50;

                if ($reqLevel + 100 <= MAX_SKILL)                   // green/grey
                    $points[] = $reqLevel + 100;

                return $points;
            default:
                return [$reqLevel];
        }
    }
}

?>
