<?php

namespace App\Providers;

use App\Repositories\MemberRepository;
use App\Repositories\MentorRepository;
use App\Repositories\CarrierRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CompanieRepository;
use App\Repositories\LearningRepository;
use App\Repositories\ProvinceRepository;
use App\Repositories\RegencieRepository;
use App\Repositories\UserskillRepository;
use App\Repositories\CarrierGroupRepository;
use App\Repositories\CarrierSkillRepository;
use App\Repositories\WorkpositionRepository;
use App\Repositories\LearningdetailRepository;
use App\Repositories\LearningGroupRepository; 
use App\Repositories\UserspecialistRepository;
use App\Repositories\MembereducationRepository;
use App\Repositories\CarrierEducationRepository;
use App\Repositories\CarrierSpecialistRepository;
use App\Repositories\CarrierdetailskillRepository;
use App\Repositories\CarrierRequirementRepository;
use App\Repositories\LearningeventGroupRepository;
use App\Repositories\MemberworkhistorieRepository;
use App\Repositories\UserworkexperienceRepository;
use App\Repositories\CarrierdetailspecialistRepository;
use App\Repositories\CarrierIndustrialsectorRepository;
use App\Repositories\Interfaces\MemberRepositoryInterface;
use App\Repositories\Interfaces\MentorRepositoryInterface;
use App\Repositories\Interfaces\CarrierRepositoryInterface;
use App\Repositories\Interfaces\CompanieRepositoryInterface;
use App\Repositories\Interfaces\LearningRepositoryInterface;
use App\Repositories\Interfaces\ProvinceRepositoryInterface;
use App\Repositories\Interfaces\RegencieRepositoryInterface;
use App\Repositories\Interfaces\UserskillRepositoryInterface;
use App\Repositories\Interfaces\CarrierGroupRepositoryInterface;
use App\Repositories\Interfaces\CarrierSkillRepositoryInterface;
use App\Repositories\Interfaces\WorkpositionRepositoryInterface;
use App\Repositories\Interfaces\LearningGroupRepositoryInterface;
use App\Repositories\Interfaces\LearningdetailRepositoryInterface;
use App\Repositories\Interfaces\UserspecialistRepositoryInterface;
use App\Repositories\Interfaces\MembereducationRepositoryInterface;
use App\Repositories\Interfaces\CarrierEducationRepositoryInterface;
use App\Repositories\Interfaces\CarrierSpecialistRepositoryInterface;
use App\Repositories\Interfaces\CarrierdetailskillRepositoryInterface;
use App\Repositories\Interfaces\CarrierRequirementRepositoryInterface;
use App\Repositories\Interfaces\LearningeventGroupRepositoryInterface;
use App\Repositories\Interfaces\MemberworkhistorieRepositoryInterface;
use App\Repositories\Interfaces\UserworkexperienceRepositoryInterface;
use App\Repositories\Interfaces\CarrierdetailspecialistRepositoryInterface;
use App\Repositories\Interfaces\CarrierIndustrialsectorRepositoryInterface;
use App\Repositories\Interfaces\LearningChartRepositoryInterface;
use App\Repositories\Interfaces\LearningObservationRepositoryInterface;
use App\Repositories\Interfaces\LearningPracticeRepositoryInterface;
use App\Repositories\Interfaces\LearningQuestionNairRepositoryInterface;
use App\Repositories\Interfaces\LearningQuestionRepositoryInterface;
use App\Repositories\Interfaces\LearningStreamRepositoryInterface;
use App\Repositories\Interfaces\LearningTransactionRepositoryInterface;
use App\Repositories\Interfaces\RatingAppDetailRepositoryInterface;
use App\Repositories\Interfaces\RatingLessonDetailRepositoryInterface;
use App\Repositories\Interfaces\RatingMentorDetailRepositoryInterface;
use App\Repositories\Interfaces\TrsLearningKuisionerRepositoryInterface;
use App\Repositories\Interfaces\TrsLearningObservationRepositoryInterface;
use App\Repositories\Interfaces\TrsLearningPracticeRepositoryInterface;
use App\Repositories\Interfaces\TrsLearningQuestionRepositoryInterface;
use App\Repositories\LearningChartRepository;
use App\Repositories\LearningObservationRepository;
use App\Repositories\LearningPracticeRepository;
use App\Repositories\LearningQuestionNairRepository;
use App\Repositories\LearningQuestionRepository;
use App\Repositories\LearningStreamRepository;
use App\Repositories\LearningTransactionRepository;
use App\Repositories\RatingAppDetailRepository;
use App\Repositories\RatingLessonDetailRepository;
use App\Repositories\RatingMentorDetailRepository;
use App\Repositories\TrsLearningKuisionerRepository;
use App\Repositories\TrsLearningObservationRepository;
use App\Repositories\TrsLearningPracticeRepository;
use App\Repositories\TrsLearningQuestionRepository;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(CarrierGroupRepositoryInterface::class, CarrierGroupRepository::class);
        $this->app->bind(CarrierRequirementRepositoryInterface::class, CarrierRequirementRepository::class);
        $this->app->bind(CarrierEducationRepositoryInterface::class, CarrierEducationRepository::class);
        $this->app->bind(CarrierIndustrialsectorRepositoryInterface::class, CarrierIndustrialsectorRepository::class);
        $this->app->bind(CarrierSpecialistRepositoryInterface::class, CarrierSpecialistRepository::class);
        $this->app->bind(CarrierSkillRepositoryInterface::class, CarrierSkillRepository::class);
        $this->app->bind(CarrierRepositoryInterface::class, CarrierRepository::class);
        $this->app->bind(CompanieRepositoryInterface::class, CompanieRepository::class);
        $this->app->bind(CarrierdetailspecialistRepositoryInterface::class, CarrierdetailspecialistRepository::class);
        $this->app->bind(RegencieRepositoryInterface::class, RegencieRepository::class);
        $this->app->bind(ProvinceRepositoryInterface::class, ProvinceRepository::class);
        $this->app->bind(CarrierdetailskillRepositoryInterface::class, CarrierdetailskillRepository::class);
        $this->app->bind(UserspecialistRepositoryInterface::class, UserspecialistRepository::class);
        $this->app->bind(UserskillRepositoryInterface::class, UserskillRepository::class);
        $this->app->bind(UserworkexperienceRepositoryInterface::class, UserworkexperienceRepository::class);
        $this->app->bind(WorkpositionRepositoryInterface::class, WorkpositionRepository::class);
        $this->app->bind(MentorRepositoryInterface::class, MentorRepository::class);
        $this->app->bind(LearningRepositoryInterface::class, LearningRepository::class);
        $this->app->bind(LearningdetailRepositoryInterface::class, LearningdetailRepository::class);
        $this->app->bind(MemberRepositoryInterface::class, MemberRepository::class);
        $this->app->bind(MembereducationRepositoryInterface::class, MembereducationRepository::class);
        $this->app->bind(MemberworkhistorieRepositoryInterface::class, MemberworkhistorieRepository::class); 
        $this->app->bind(LearningGroupRepositoryInterface::class, LearningGroupRepository::class); 
        $this->app->bind(LearningeventGroupRepositoryInterface::class, LearningeventGroupRepository::class); 
        $this->app->bind(RatingAppDetailRepositoryInterface::class, RatingAppDetailRepository::class); 
        $this->app->bind(RatingMentorDetailRepositoryInterface::class, RatingMentorDetailRepository::class); 
        $this->app->bind(RatingLessonDetailRepositoryInterface::class, RatingLessonDetailRepository::class); 
        $this->app->bind(LearningTransactionRepositoryInterface::class, LearningTransactionRepository::class); 
        $this->app->bind(LearningChartRepositoryInterface::class, LearningChartRepository::class); 
        $this->app->bind(LearningStreamRepositoryInterface::class, LearningStreamRepository::class); 
        $this->app->bind(LearningQuestionRepositoryInterface::class, LearningQuestionRepository::class); 
        $this->app->bind(LearningQuestionNairRepositoryInterface::class, LearningQuestionNairRepository::class); 
        $this->app->bind(LearningObservationRepositoryInterface::class, LearningObservationRepository::class); 
        $this->app->bind(LearningPracticeRepositoryInterface::class, LearningPracticeRepository::class); 
        $this->app->bind(TrsLearningKuisionerRepositoryInterface::class, TrsLearningKuisionerRepository::class); 
        $this->app->bind(TrsLearningQuestionRepositoryInterface::class, TrsLearningQuestionRepository::class); 
        $this->app->bind(TrsLearningPracticeRepositoryInterface::class, TrsLearningPracticeRepository::class); 
        $this->app->bind(TrsLearningObservationRepositoryInterface::class, TrsLearningObservationRepository::class); 
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        VerifyEmail::toMailUsing(function (object $notifiable, string $url){
            $parts = parse_url($url);
            $verifyEmailUrl = 'localhost:5173/verify-mail?id='
                . $notifiable->getKey() . '&hash=' .  sha1($notifiable->getEmailForVerification())
                . '&' . $parts['query'];
            return (new MailMessage)
            ->subject('Verify Email Address')
            ->greeting('Hello '. $notifiable->firstname)
            ->line('Click the button below to verify your email address.')
            ->action('Verify Email Address', $verifyEmailUrl)
            ->line(('If you did not create an account, no furher action is required.'));
        });
    }
}
