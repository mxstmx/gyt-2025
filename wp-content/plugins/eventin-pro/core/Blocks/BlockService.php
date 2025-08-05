<?php
namespace EventinPro\Blocks;

use Eventin\Interfaces\HookableInterface;
use EventinPro\Blocks\BlockTypes\BuyTicket;
use EventinPro\Blocks\BlockTypes\EventAddToCalender;
use EventinPro\Blocks\BlockTypes\EventBanner;
use EventinPro\Blocks\BlockTypes\EventCategory;
use EventinPro\Blocks\BlockTypes\EventCountDownTimer;
use EventinPro\Blocks\BlockTypes\EventDateTime;
use EventinPro\Blocks\BlockTypes\EventDescription;
use EventinPro\Blocks\BlockTypes\EventOrganizer;
use EventinPro\Blocks\BlockTypes\EventSchedule;
use EventinPro\Blocks\BlockTypes\EventSpeaker;
use EventinPro\Blocks\BlockTypes\EventTag;
use EventinPro\Blocks\BlockTypes\EventVenue;
use EventinPro\Blocks\BlockTypes\RelatedEvents;
use EventinPro\Blocks\BlockTypes\EventLogo;
use EventinPro\Blocks\BlockTypes\EventFaq;
use EventinPro\Blocks\BlockTypes\EventRSVP;
use EventinPro\Blocks\BlockTypes\EventSocial;
use EventinPro\Blocks\BlockTypes\EventTitle;
use EventinPro\Blocks\BlockTypes\RecurringEvent;

/**
 * Block Service Class
 */
class BlockService implements HookableInterface {
    /**
     * Register all hooks
     *
     * @return  void
     */
    public function register_hooks(): void {
        add_filter( 'eventin_gutenberg_blocks', [ $this, 'add_blocks' ] );        
    }

    /**
     * Added blocks
     *
     * @return  array
     */
    public function add_blocks( $blocks ) {
        $new_blocks = [
            EventVenue::class,
            BuyTicket::class,
            RelatedEvents::class,
            EventLogo::class,
            EventFaq::class,
            EventRSVP::class,
            EventSpeaker::class,
            EventOrganizer::class,
            EventBanner::class,
            EventDateTime::class, 
            EventTag::class,
            EventCategory::class,
            EventSchedule::class,
            RecurringEvent::class,
            EventTitle::class,
            EventDescription::class,
            EventAddToCalender::class,
            EventSocial::class,
            EventCountDownTimer::class
        ];

        return array_unique( array_merge( $blocks, $new_blocks ) );
    }
}


