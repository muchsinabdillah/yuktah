<?php

namespace App\Providers;

use App\Repositories\CarrierGroupRepository;
use App\Repositories\Interfaces\CarrierGroupRepositoryInterface;
use App\Repositories\CarrierRequirementRepository;
use App\Repositories\Interfaces\CarrierRequirementRepositoryInterface;
use App\Repositories\CarrierEducationRepository;
use App\Repositories\Interfaces\CarrierEducationRepositoryInterface;
use App\Repositories\CarrierIndustrialsectorRepository;
use App\Repositories\Interfaces\CarrierIndustrialsectorRepositoryInterface;
use App\Repositories\CarrierSpecialistRepository;
use App\Repositories\Interfaces\CarrierSpecialistRepositoryInterface;
use App\Repositories\CarrierSkillRepository;
use App\Repositories\Interfaces\CarrierSkillRepositoryInterface;
use App\Repositories\CarrierRepository;
use App\Repositories\Interfaces\CarrierRepositoryInterface;
use App\Repositories\CompanieRepository;
use App\Repositories\Interfaces\CompanieRepositoryInterface;
use App\Repositories\CarrierdetailspecialistRepository;
use App\Repositories\Interfaces\CarrierdetailspecialistRepositoryInterface;
use App\Repositories\RegencieRepository;
use App\Repositories\Interfaces\RegencieRepositoryInterface;
use App\Repositories\ProvinceRepository;
use App\Repositories\Interfaces\ProvinceRepositoryInterface;
use App\Repositories\CarrierdetailskillRepository;
use App\Repositories\Interfaces\CarrierdetailskillRepositoryInterface;
use App\Repositories\UserspecialistRepository;
use App\Repositories\Interfaces\UserspecialistRepositoryInterface;
use App\Repositories\UserskillRepository;
use App\Repositories\Interfaces\UserskillRepositoryInterface;
use App\Repositories\UserworkexperienceRepository;
use App\Repositories\Interfaces\UserworkexperienceRepositoryInterface;
use App\Repositories\LearningGroupRepository;
use App\Repositories\Interfaces\LearningGroupRepositoryInterface;
use App\Repositories\LearningeventGroupRepository;
use App\Repositories\Interfaces\LearningeventGroupRepositoryInterface;
use App\Repositories\WorkpositionRepository;
use App\Repositories\Interfaces\WorkpositionRepositoryInterface;
use App\Repositories\MentorRepository;
use App\Repositories\Interfaces\MentorRepositoryInterface;
use App\Repositories\LearningRepository;
use App\Repositories\Interfaces\LearningRepositoryInterface;
use App\Repositories\LearningdetailRepository;
use App\Repositories\Interfaces\LearningdetailRepositoryInterface;
use Illuminate\Support\ServiceProvider;

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
        $this->app->bind(LearningGroupRepositoryInterface::class, LearningGroupRepository::class);
        $this->app->bind(LearningeventGroupRepositoryInterface::class, LearningeventGroupRepository::class);
        $this->app->bind(WorkpositionRepositoryInterface::class, WorkpositionRepository::class);
        $this->app->bind(MentorRepositoryInterface::class, MentorRepository::class);
        $this->app->bind(LearningRepositoryInterface::class, LearningRepository::class);
        $this->app->bind(LearningdetailRepositoryInterface::class, LearningdetailRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
