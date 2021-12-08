<?php

namespace App\DataFixtures;

use App\Entity\Program;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
        [
            'title' => 'The Walking Dead',
            'summary' => 'L\'histoire suit le personnage de Rick Grimes (interprété par Andrew Lincoln), 
            adjoint du shérif du comté de Kings (en Géorgie). Il se réveille d\'un coma de plusieurs semaines 
            pour découvrir que la population a été ravagée par une épidémie inconnue 
            qui transforme les êtres humains en morts-vivants, 
            appelés « rôdeurs ». Après avoir retrouvé sa famille, 
            il devient très vite le chef d\'un groupe de rescapés d\'Atlanta. 
            Ceux-ci sont amenés à devoir survivre dans un monde post-apocalyptique, 
            affrontant des rôdeurs et d\'autres groupes de survivants, 
            pour certains plus dangereux encore que les rôdeurs eux-mêmes. 
            Ensemble, ils doivent faire face tant bien que mal à un monde devenu méconnaissable, 
            durant leur périple à travers le sud profond des États-Unis.',
            'poster' => 'https://photos.tf1.fr/700/933/the-walking-dead-vignette_portrait-09f433-0@1x.webp',
            'category_id' => '4',
            'actor_id' => [0,1,2,3,4],
        ],
        [
            'title' => 'Arcane',
            'summary' => 'La série a lieu dans le monde de Runeterra, 
            l\'univers fictif de Riot Games dans lequel prennent également place les jeux League of Legends, 
            Teamfight Tactics, Legends of Runeterra et League of Legends: Wild Rift.
            L\'intrigue se déroule plus précisément à Piltover et Zaun, 
            deux villes en conflit situées au même endroit — Piltover constituant la partie supérieure et riche de la cité ; 
            Zaun ses souterrains insalubres, dont la population souffre de la pauvreté. 
            Le scénario suit principalement Jinx et Vi, deux sœurs ayant vécu une difficile enfance à Zaun, 
            mais qui, désormais adultes, mènent une vie très différente l\'une de l\'autre, ainsi que Jayce et Viktor, 
            deux scientifiques ayant découvert et stabilisé une molécule permettant de grandes avancées technologiques.',
            'poster' => 'https://media-mcetv.ouest-france.fr/wp-content/uploads/2021/11/arcane-la-serie-netflix-inspiree-de-lol-aura-droit-a-une-saison-2jpeg-min.jpeg',
            'category_id' => '0',
        ],
        [
            'title' => 'Your Lie In April',
            'summary' => 'Arima Kōsei est un jeune pianiste de renom. 
            Petit prodige depuis son plus jeune âge, 
            communément appelé « métronome humain », 
            il excelle dans toutes les compétitions auxquelles il participe en donnant une prestation 
            reproduisant avec exactitude une partition. Cependant, 
            sa mère qui est à la fois pianiste et son professeur décède subitement des suites d\'une grave maladie 
            dont les causes sont inconnues et Kōsei rate un concours qui aurait pu le conduire à jouer du piano à 
            l\'international. Il abandonne de ce fait le piano et tout son passé. Deux ans plus tard, 
            Kōsei rentre en dernière année de collège et fait la connaissance de Kaōri Miyazono, 
            une violoniste du même âge que lui et qui est dans la même classe que sa voisine et sœur de cœur, 
            Tsubaki, dont il va tomber immédiatement amoureux. Alors qu\'il s\'était juré de ne plus jamais parler de piano, 
            il ne peut pas réellement se séparer de son passé musical. Kaōri va alors redoubler de courage pour recréer le 
            lien entre Kōsei et le piano en lui proposant de devenir son pianiste accompagnateur pour ses compétitions. 
            Cependant, le jeune homme ne s\'est jamais vraiment remis de la mort de sa mère, et n\'est plus capable 
            d\'entendre les notes de son piano, ce que empêche celui-ci d\'exceller dans sa préstation.',
            'poster' => 'https://fr.web.img4.acsta.net/pictures/19/07/11/17/07/1342802.jpg',
            'category_id' => '4',
        ],
        [
            'title' => 'Food Wars',
            'summary' => 'Sôma Yukihira rêve de devenir chef cuisinier dans le restaurant familial 
            et ainsi surpasser les talents culinaires de son père. Alors que Sôma vient juste d\'être diplômé au collège, 
            son père Jôichirô Yukihira ferme le restaurant pour partir cuisiner à travers le monde. 
            L\'esprit de compétition de Sôma va alors être mis à l\'épreuve par son père qui lui conseille de 
            rejoindre une école d\'élite culinaire, où seuls 10 % des élèves sont diplômés. Sôma va-t-il parvenir à 
            atteindre son objectif ?',
            'poster' => 'https://upload.wikimedia.org/wikipedia/en/d/d3/Shokugeki_no_Souma_Volume_1.jpg',
            'category_id' => '2',
        ],
        [
            'title' => 'Violet Evergarden',
            'summary' => 'L\'histoire se déroule autour d\'une jeune fille qui effectue le métier de 
            « poupées de souvenirs automatiques » (自動手記人形, Jidō shuki ningyō?, en anglais : Auto Memory Dolls) : 
            des poupées initialement créées par le professeur Orland pour aider sa femme aveugle Mollie à écrire ses romans, 
            et plus tard louées à d\'autres personnes qui avaient besoin de leurs services. Le terme se réfère aux personnes 
            qui remplissent la fonction d\'écrivain public, dont le but est de retranscrire la parole et les sentiments des gens. 
            Après quatre ans de guerre acharnée, cette jeune fille au lourd passé tente non sans mal de reconstruire son avenir, 
            à commencer par l\'exercice de ce métier. Cependant, parmi toutes les blessures qui lui auront été infligées au 
            cours de la guerre, il y en a une qui semble ne pas vouloir se refermer. Les mots d\'un être cher résonnent encore 
            dans son cœur, sans que la jeune fille en sache la véritable raison. Elle veut savoir, comprendre leur signification. 
            Ainsi commence la quête de Violet Evergarden, apprentissage mêlé de lettres, de rencontres et d\'émotions variées…',
            'poster' => 'https://media.senscritique.com/media/000017531482/source_big/Violet_Evergarden.jpg',
            'category_id' => '5',
        ]
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as $key => $program) {
            $newProgram = new Program();
            $slug  = new Slugify();
            $newProgram->setTitle($program['title']);
            $newProgram->setSummary($program['summary']);
            $newProgram->setPoster($program['poster']);
            $newProgram->setCategory($this->getReference('category_' . $program['category_id']));
            $newProgram->setSlug($slug->generate($newProgram->getTitle()));
            if (isset($program['actor_id'])) {
                foreach ($program['actor_id'] as $actorId) {
                    $newProgram->addActor($this->getReference('actor_' . $actorId));
                }
            }
            $manager->persist($newProgram);
            $this->addReference('program_'  . $key, $newProgram);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [ActorFixtures::class, CategoryFixtures::class];
    }
}
