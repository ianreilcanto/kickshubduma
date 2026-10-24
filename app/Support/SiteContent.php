<?php

namespace App\Support;

use App\Models\SitePage;
use Illuminate\Support\Facades\Schema;

class SiteContent
{
    /** Stored content merged over the defaults; repeater lists are re-indexed. */
    public static function get(string $page): array
    {
        $stored = [];

        if (Schema::hasTable('site_pages')) {
            $stored = SitePage::where('page', $page)->value('content') ?? [];
        }

        $content = array_replace(static::defaults($page), array_filter(
            $stored,
            fn ($value) => $value !== null && $value !== '',
        ));

        return array_map(fn ($value) => is_array($value) ? array_values($value) : $value, $content);
    }

    public static function save(string $page, array $data): void
    {
        SitePage::updateOrCreate(['page' => $page], ['content' => $data]);
    }

    public static function defaults(string $page): array
    {
        return match ($page) {
            'home' => static::home(),
            'about' => static::about(),
            'products' => static::products(),
            'athletes' => static::athletes(),
            default => [],
        };
    }

    private static function products(): array
    {
        return [
            'announcement_title' => 'DUMAGUETE ROOTS. EVERYDAY MOVEMENT.',
            'announcement_text' => 'Free PH shipping on orders ₱5,000+ · Find your next pair →',
            'intro_eyebrow' => 'THE KICKS HUB DUMA STORE',
            'intro_title' => "FIND YOUR\nNEXT MOVE.",
            'intro_subtitle' => "Fresh pairs. Better rallies. Your next go-to kit.\nConsidered gear for every version of your game.",
            'art_stamp_main' => 'GAME',
            'art_note' => 'COURT / STREET / EVERYDAY',
            'filter_note_title' => 'Made for your game.',
            'filter_note_text' => 'Need help with fit or gear? Our local crew can help you find your pair.',
            'catalogue_footer' => 'Showing a curated edit of the Kicks Hub Duma store',
            'empty_title' => 'No gear found.',
            'empty_text' => 'Try changing your filters or searching another term.',
            'help_eyebrow' => 'LOCAL KNOW-HOW. BETTER FIT.',
            'help_title' => "GOOD GEAR STARTS\nWITH A GOOD FIT.",
            'help_text' => 'Not sure what works for your game? Get advice from people who play here, too.',
            'help_button' => 'TALK TO THE CREW',
            'contact_email' => 'hello@kickshubduma.example',
            'footer_copyright' => '© 2026 Kicks Hub Duma. Made for the local game.',
        ];
    }

    private static function athletes(): array
    {
        return [
            'announcement_title' => 'DUMAGUETE ROOTS. EVERYDAY MOVEMENT.',
            'announcement_text' => 'Free PH shipping on orders ₱5,000+ · Find your next pair →',
            'intro_eyebrow' => 'THE PEOPLE BEHIND THE MOVEMENT',
            'intro_title' => "DIFFERENT GAMES.\nSAME LOCAL SOUL.",
            'intro_text' => 'Not just podiums and personal bests. We celebrate the people who lace up, show up, and bring a little more heart to the game.',
            'intro_link' => 'MEET THE DUMA CREW',
            'disclosure' => 'CONCEPT ROSTER — Fictional athletes and original portraits, created to tell our story. No real-world endorsements.',
            'show_disclosure' => true,
            'crew_eyebrow' => 'OUR ATHLETES / OUR EVERYDAY INSPIRATION',
            'crew_title' => 'GOOD COMPANY. GREAT ENERGY.',
            'crew_note' => 'Three stories. One shared spirit.',
            'routine_eyebrow' => 'BEHIND THE ROUTINE',
            'routine_title' => "SHOW UP.\nPUT IN THE WORK.\nDO IT AGAIN.",
            'routine_text' => 'Every athlete has a rhythm. Small habits, repeated daily, make room for big moments.',
            'rituals' => [
                ['time' => '05:30', 'title' => 'Start before the noise', 'text' => 'Quiet streets, a clear head, and a few miles to find your pace.'],
                ['time' => '16:00', 'title' => 'Put in the reps', 'text' => 'Work on the basics. Keep it simple. Keep getting better.'],
                ['time' => '18:30', 'title' => 'Play with your people', 'text' => 'Meet the crew, share the court, and make the day count.'],
            ],
            'gear_eyebrow' => 'PICKS FROM THE CREW',
            'gear_title' => 'GEAR THAT GETS OUT THERE.',
            'gear_button' => 'SHOP ALL GEAR',
            'gear_limit' => 3,
            'categories_eyebrow' => 'FIND YOUR NEXT PAIR',
            'categories_title' => 'MADE FOR YOUR KIND OF MOVE.',
            'categories_note' => 'Find your game. Find your fit.',
            'category_cards' => [
                ['tag' => '01 / COURT COLLECTION', 'title' => "COURT\nREADY."],
                ['tag' => '02 / RUN COLLECTION', 'title' => "FIND\nYOUR PACE."],
                ['tag' => '03 / EVERYDAY', 'title' => "MOVE\nYOUR WAY."],
            ],
            'spotlight_eyebrow' => 'MORE THAN A PAIR OF SHOES',
            'spotlight_title' => "BUILT FOR THE\nONES WHO SHOW UP.",
            'spotlight_text' => 'We’re here for the early starts, the last-minute games, and the people who make every session worth it.',
            'spotlight_identity' => 'KICKS HUB DUMA',
            'spotlight_identity_sub' => 'LOCAL MOVEMENT. SHARED ENERGY.',
            'spotlight_button' => 'OUR STORY',
            'kit_eyebrow' => 'THE EVERYDAY KIT',
            'kit_title' => "YOUR NEXT\nSESSION STARTS HERE.",
            'kit_text' => 'Good gear won’t do the work for you. But it can help you show up ready.',
            'kit_button' => 'EXPLORE THE KIT',
            'kit_art' => 'TRAIN / PLAY / REPEAT',
            'local_mark' => 'ROOTED HERE. READY TO MOVE.',
            'local_eyebrow' => 'OUR LOCAL STORY',
            'local_title' => "A LITTLE LOCAL PRIDE.\nA LOT OF LOVE FOR THE GAME.",
            'local_text' => 'Kicks Hub Duma is inspired by the energy of Dumaguete — a place where community comes together through sport, movement, and everyday moments.',
            'local_button' => 'BE PART OF THE CLUB',
            'fit_title' => 'Not sure about your fit?',
            'fit_text' => 'Find your size and get ready to move comfortably.',
            'fit_button' => 'FIND YOUR FIT',
            'journal_eyebrow' => 'FIELD NOTES / FROM THE CLUB',
            'journal_title' => 'GOOD GAMES. GOOD STORIES.',
            'journal_link' => 'READ ALL STORIES',
            'journal' => [
                ['tag' => 'COMMUNITY / 4 MIN READ', 'title' => 'Why showing up is the real win', 'text' => 'The small rituals that make movement stick.'],
                ['tag' => 'TRAINING / 5 MIN READ', 'title' => 'Build a routine you can keep', 'text' => 'Progress starts with the basics.'],
                ['tag' => 'LOCAL LIFE / 3 MIN READ', 'title' => 'Meet you at the court', 'text' => 'It’s always better when we play together.'],
            ],
            'newsletter_eyebrow' => 'JOIN THE CLUB',
            'newsletter_title' => 'GOOD THINGS MOVE TOGETHER.',
            'newsletter_text' => 'Get new drops, local stories, and club updates in your inbox.',
            'newsletter_fine_print' => 'By signing up, you agree to receive occasional updates from Kicks Hub Duma.',
            'footer_copyright' => '© 2026 Kicks Hub Duma. Concept storefront.',
        ];
    }

    private static function home(): array
    {
        return [
            'announcement_title' => 'DUMAGUETE ROOTS. EVERYDAY MOVEMENT.',
            'announcement_text' => 'Free PH shipping on orders ₱5,000+ · Find your next pair →',
            'hero_eyebrow' => 'THE DUMA EDIT / VOL. 01 — 2026',
            'hero_title' => "GOOD KICKS.\nREAL GAME.",
            'hero_highlight' => 'LOCAL SOUL.',
            'hero_text' => 'From the first lace-up to the last point. Find shoes, paddle gear and kits that move with you. Rooted in Dumaguete. Ready for anywhere.',
            'hero_primary_button' => 'SHOP SHOES',
            'hero_secondary_button' => 'EXPLORE THE STORE',
            'hero_note' => 'COURT CLASSICS. EVERYDAY ROTATION.',
            'hero_caption' => 'THE EVERYDAY STARTING FIVE',
            'hero_seal_top' => 'BUILT FOR',
            'hero_seal_main' => 'THE GAME',
            'hero_seal_bottom' => '& THE EVERYDAY',
            'feature_title' => 'Baseline 01 — Varsity Red',
            'feature_text' => 'A new classic for your rotation. / ₱4,250',
            'ribbon' => [
                ['text' => 'FOR THE LOVE OF THE GAME'],
                ['text' => 'KICKS HUB DUMA'],
                ['text' => 'FROM OUR CITY. FOR YOUR NEXT MOVE.'],
                ['text' => 'KICKS HUB DUMA'],
            ],
            'assurances' => [
                ['icon' => '↗', 'title' => 'PH-WIDE DELIVERY', 'text' => 'Free shipping on orders ₱5,000+'],
                ['icon' => '▣', 'title' => 'AUTHENTIC PICKS', 'text' => 'Gear picked for your game'],
                ['icon' => '↻', 'title' => 'LOCAL SUPPORT', 'text' => 'Real people, right here in Duma'],
                ['icon' => '⌖', 'title' => 'ROOTED IN DUMAGUETE', 'text' => 'Made for our local community'],
            ],
            'categories_eyebrow' => 'FIND YOUR NEXT MOVE',
            'categories_title' => 'GEAR UP.',
            'categories_highlight' => 'GET OUT THERE.',
            'categories_link' => 'VIEW ALL PRODUCTS',
            'category_cards' => [
                ['tag' => '01 / FOOTWEAR', 'title' => "SHOES THAT\nSHOW UP.", 'cta' => 'SHOP SHOES'],
                ['tag' => '02 / COURT GEAR', 'title' => "OWN YOUR\nCOURT.", 'cta' => 'SHOP COURT GEAR'],
                ['tag' => '03 / APPAREL', 'title' => "MADE TO\nMOVE.", 'cta' => 'SHOP APPAREL'],
            ],
            'products_eyebrow' => 'THE LOCAL ROTATION',
            'products_title' => 'GOOD THINGS.',
            'products_highlight' => 'GOOD GAME.',
            'products_limit' => 4,
            'athletes_eyebrow' => 'BUILT BY THE COMMUNITY',
            'athletes_title' => "OUR CITY.\nOUR",
            'athletes_highlight' => 'ATHLETES.',
            'athletes_text' => 'Meet the players putting Dumaguete on the court. We back local talent, celebrate the work, and keep showing up for the game.',
            'athletes_button' => 'MEET OUR ATHLETES',
            'athletes_label' => 'LOCAL TALENT. BIG GAME.',
            'athletes_index' => '01 — COMMUNITY SPOTLIGHT',
            'story_eyebrow' => 'MORE THAN A STORE',
            'story_title' => 'ROOTED HERE.',
            'story_highlight' => 'READY FOR ANYWHERE.',
            'story_text' => 'Kicks Hub Duma is for the early runs, after-work games, weekend rallies and everyday moves. A local sports club for people who love to play.',
            'story_link' => 'OUR STORY',
            'story_location' => 'DUMAGUETE, NEGROS ORIENTAL',
            'newsletter_eyebrow' => 'STAY IN THE ROTATION',
            'newsletter_title' => 'GOOD NEWS.',
            'newsletter_highlight' => 'NO NOISE.',
            'newsletter_text' => 'New drops, local events and community stories — straight to your inbox.',
            'footer_tagline' => 'GOOD KICKS. REAL GAME. LOCAL SOUL.',
            'footer_copyright' => '© 2026 Kicks Hub Duma. Made for the love of the game.',
        ];
    }

    private static function about(): array
    {
        return [
            'announcement_title' => 'DUMAGUETE ROOTS. EVERYDAY MOVEMENT.',
            'announcement_text' => 'Free PH shipping on orders ₱5,000+ · Find your next pair →',
            'intro_eyebrow' => 'OUR CITY. OUR PEOPLE. OUR KIND OF STORE.',
            'intro_title' => "GOOD KICKS BRING\nGOOD PEOPLE\nTOGETHER.",
            'intro_lead' => 'We’re Kicks Hub Duma. A home for people who love their shoes, their sport, and the city they play in.',
            'emblem_caption' => 'ROOTED IN DUMAGUETE',
            'court_tag' => 'LOCAL PEOPLE. LOCAL PLACES.',
            'court_small' => 'DUMA / COMMUNITY COURT',
            'court_title' => "THE GAME IS BETTER\nTOGETHER.",
            'court_location' => 'DUMAGUETE / NEGROS ORIENTAL / PH',
            'story_eyebrow' => 'THE IDEA BEHIND THE HUB',
            'story_title' => "LESS HYPE.\nMORE HEART.\nALWAYS GAME.",
            'story_heading' => 'Some people see a pair of shoes. We see the games, places and people that come with them.',
            'story_paragraphs' => [
                ['text' => 'That’s the spirit behind Kicks Hub Duma: a considered sports store with a hometown point of view. A place to discover a court-ready pair, pick up your next paddle, or find a kit that makes you feel part of something.'],
                ['text' => 'Our name carries our city. Our choices carry our love of sport. Whether you’re chasing a personal best or just heading out with friends, there’s room for you here.'],
            ],
            'story_signature' => '━━━━ FROM DUMA. WITH LOVE FOR THE GAME.',
            'values_eyebrow' => 'OUR NON-NEGOTIABLES',
            'values_title' => 'THE THINGS WE STAND FOR.',
            'values_tag' => 'THREE PRINCIPLES. ONE HUB.',
            'values' => [
                ['title' => "GOOD GEAR,\nHONESTLY.", 'text' => 'Wearability over noise. We look for comfort, considered design and gear that earns a place in your everyday rotation.'],
                ['title' => "PEOPLE BEFORE\nHYPE.", 'text' => 'You don’t need to be a pro to belong here. First-timers, lifelong players and everyone in between are part of the crew.'],
                ['title' => "LOCAL IS OUR\nLANGUAGE.", 'text' => 'From neighborhood courts to everyday streets, our city shapes our perspective. We keep that connection close.'],
            ],
            'collection_eyebrow' => 'CONSIDERED. NOT COMPLICATED.',
            'collection_title' => "A BETTER ROTATION\nSTARTS HERE.",
            'collection_paragraphs' => [
                ['text' => 'We keep our collection focused on the things you’ll reach for again and again: reliable shoes, court essentials and everyday kit that feels right on and off the court.'],
                ['text' => 'Good design should work hard without making a fuss. That’s what we look for, and what we bring to the Hub.'],
            ],
            'collection_button' => 'EXPLORE THE STORE',
            'closing_eyebrow' => 'YOUR CITY. YOUR PEOPLE. YOUR GAME.',
            'closing_title' => 'SEE YOU OUT THERE.',
            'closing_text' => 'Whether you’re here for your first pair or your next big match, there’s a place for you at the Hub.',
            'closing_button' => 'COME FIND YOUR GEAR',
        ];
    }
}
