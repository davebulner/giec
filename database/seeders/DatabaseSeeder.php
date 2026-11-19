<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Inquiry;
use App\Models\Program;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@giecollege.com'],
            [
                'name' => 'GIEC Admissions Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $departmentsData = [
            [
                'name' => 'English & Languages',
                'slug' => 'english-languages',
                'description' => 'Internationally benchmarked English proficiency, academic writing, and UK-accredited language pedagogy pathways.',
            ],
            [
                'name' => 'Business & Management',
                'slug' => 'business-management',
                'description' => 'UK-aligned business diplomas, Higher National Diplomas, top-up degrees, and strategic executive leadership qualifications.',
            ],
            [
                'name' => 'Information Technology',
                'slug' => 'information-technology',
                'description' => 'Industry-driven software engineering, web architecture, cloud operations, and applied computing qualifications.',
            ],
            [
                'name' => 'Hospitality & Tourism',
                'slug' => 'hospitality-tourism',
                'description' => 'Global hotel operations, guest experience management, and international tourism pathways tailored for Sri Lanka and abroad.',
            ],
        ];

        $departments = [];
        foreach ($departmentsData as $dept) {
            $departments[$dept['slug']] = Department::updateOrCreate(
                ['slug' => $dept['slug']],
                $dept
            );
        }

        $programs = [
            [
                'department_slug' => 'english-languages',
                'title' => 'Diploma in English (UK)',
                'slug' => 'diploma-in-english-uk',
                'level' => 'Diploma',
                'formats' => ['On-Campus', 'Online'],
                'duration' => '6 Months (Full-Time / Weekend)',
                'next_intake' => 'January & May Intakes',
                'accreditation' => 'UK / Spinnaker School Accredited',
                'summary' => 'An internationally structured UK-accredited English diploma equipping students and professionals with fluent academic writing, public speaking, and workplace communication mastery.',
                'overview' => "Designed in alignment with UK academic standards and Spinnaker School pedagogy, the Diploma in English (UK) builds comprehensive mastery across grammar architecture, academic composition, phonetics, and persuasive executive communication.\n\nGraduates advance confidently into Higher National Diplomas, international university degree pathways, corporate leadership roles, and IELTS/OET preparation tracks with recognized UK certification.",
                'modules' => [
                    [
                        'title' => 'Module 1: Advanced Grammar & Syntax Architecture',
                        'description' => 'Structural accuracy, complex clause formation, tense consistency, and editorial proofreading for professional documents.',
                    ],
                    [
                        'title' => 'Module 2: Phonetics, Pronunciation & Oracy Lab',
                        'description' => 'Received Pronunciation clarity, intonation patterns, active listening drills, and confident vocal delivery.',
                    ],
                    [
                        'title' => 'Module 3: Academic Reading & Critical Writing',
                        'description' => 'Essay structuring, synthesis of academic texts, referencing conventions, and formal analytical report writing.',
                    ],
                    [
                        'title' => 'Module 4: Business & Executive Communication',
                        'description' => 'Corporate correspondence, boardroom presentations, negotiation language, and cross-cultural etiquette.',
                    ],
                    [
                        'title' => 'Module 5: Public Speaking & Capstone Assessment',
                        'description' => 'Evaluated live seminar presentation, portfolio review, and final UK-standard diagnostic examination.',
                    ],
                ],
                'entry_requirements' => [
                    'G.C.E. O/L pass in English or equivalent foundational proficiency.',
                    'Completion of GIEC quick oral & written placement diagnostic.',
                    'Minimum age 16+ (school leavers, undergraduates, and working adults welcome).',
                ],
                'student_packages' => [
                    [
                        'name' => 'Standard Track Package',
                        'fee' => 'LKR 65,000',
                        'badge' => 'Popular',
                        'features' => [
                            '24 weeks of live interactive lectures (Colombo 03 or Zoom)',
                            'Digital Cambridge & UK Spinnaker study workbooks',
                            'Continuous formative assessments & trainer feedback',
                            'GIEC Academic Completion Certificate',
                        ],
                    ],
                    [
                        'name' => 'Fast-Track Intensive Package',
                        'fee' => 'LKR 85,000',
                        'badge' => '12-Week Express',
                        'features' => [
                            'Accelerated 12-week intensive schedule with small-group coaching',
                            'Weekly 1-on-1 speaking clinic with UK-certified faculty',
                            'Printed course reader + LMS recorded lecture archive',
                            'Priority progression assessment for HND / Degree entry',
                        ],
                    ],
                    [
                        'name' => 'Complete UK Certification Package',
                        'fee' => 'LKR 110,000',
                        'badge' => 'Best Value',
                        'features' => [
                            'Full tuition + UK Spinnaker external moderation & registration fee',
                            'Official UK-endorsed Diploma transcript & embossed certificate',
                            'Complimentary IELTS Academic readiness workshop (12 hours)',
                            'Flexible 3-month interest-free installment plan included',
                        ],
                    ],
                ],
                'is_featured' => true,
                'is_published' => true,
            ],
            [
                'department_slug' => 'english-languages',
                'title' => 'London English Proficiency Program (Levels 1–10)',
                'slug' => 'london-english-proficiency-program-levels-1-10',
                'level' => 'Certificate',
                'formats' => ['On-Campus', 'Online', 'Hybrid'],
                'duration' => '3–12 Months (Level-Based)',
                'next_intake' => 'Monthly Rolling Intakes',
                'accreditation' => 'CEFR & Spinnaker Levels 1–10 Pathway',
                'summary' => 'A structured 10-level progressive English mastery pathway mapped to CEFR A1 through C2, taking learners from foundational confidence to native-grade fluency.',
                'overview' => "The London English Proficiency Program (Levels 1–10) provides a clear, measurable pathway for learners at any starting point. Every student completes an initial diagnostic placement test and enters at the exact level suited to their current speaking, listening, reading, and writing capability.\n\nEach level combines communicative immersion, guided pronunciation clinics, real-world scenario labs, and milestone certifications ideal for international study, migration readiness, and career advancement.",
                'modules' => [
                    [
                        'title' => 'Levels 1–3: Foundation & Everyday Fluency (CEFR A1–A2)',
                        'description' => 'Core vocabulary building, essential sentence structures, conversational confidence, and everyday listening comprehension.',
                    ],
                    [
                        'title' => 'Levels 4–6: Intermediate Communication & Workplace English (CEFR B1)',
                        'description' => 'Fluent narrative speaking, email composition, telephone/meeting skills, and structured paragraph writing.',
                    ],
                    [
                        'title' => 'Levels 7–8: Upper-Intermediate Academic & Analytical Fluency (CEFR B2)',
                        'description' => 'Debate and argumentation, critical reading, formal reports, and nuanced idiomatic expression.',
                    ],
                    [
                        'title' => 'Levels 9–10: Executive & Mastery Certification (CEFR C1–C2)',
                        'description' => 'C-suite communication, academic research synthesis, persuasive keynote speaking, and final proficiency examination.',
                    ],
                ],
                'entry_requirements' => [
                    'Open entry across all ages (14+ for teen/adult cohorts).',
                    'Mandatory 20-minute GIEC placement check to assign starting level (Level 1 to Level 10).',
                    'Laptop or smartphone access for Hybrid/Online practice portal.',
                ],
                'student_packages' => [
                    [
                        'name' => 'Single-Level Certificate Package',
                        'fee' => 'LKR 24,000',
                        'badge' => 'Flexible Entry',
                        'features' => [
                            '6-week targeted module for your placed proficiency level',
                            'Diagnostic entry test & personalized progress scorecard',
                            'Interactive speaking studio access (Colombo 03 or Online)',
                            'Level completion certificate mapped to CEFR scale',
                        ],
                    ],
                    [
                        'name' => '3-Level Progression Bundle',
                        'fee' => 'LKR 64,000',
                        'badge' => 'Most Popular',
                        'features' => [
                            '18 weeks covering 3 consecutive proficiency levels',
                            'Printed & digital Spinnaker London workbooks included',
                            'Bi-weekly 1-on-1 pronunciation & fluency clinic',
                            'Official progression transcript across all 3 levels',
                        ],
                    ],
                    [
                        'name' => 'Full Mastery Pathway (Levels 1–10)',
                        'fee' => 'LKR 145,000',
                        'badge' => 'Complete Track',
                        'features' => [
                            'Unlimited progression support up to Level 10 (CEFR C1/C2)',
                            'Full UK-benchmarked final proficiency certification',
                            'IELTS / PTE academic exam strategy masterclasses',
                            'Monthly installment plan available across 6 months',
                        ],
                    ],
                ],
                'is_featured' => true,
                'is_published' => true,
            ],
            [
                'department_slug' => 'business-management',
                'title' => 'Higher National Diploma (HND) in Business Management',
                'slug' => 'higher-national-diploma-business-management',
                'level' => 'Undergraduate',
                'formats' => ['On-Campus', 'Hybrid'],
                'duration' => '18–24 Months (240 UK Credits)',
                'next_intake' => 'February & September Intakes',
                'accreditation' => 'UK RQF Level 4 & Level 5 Pathway',
                'summary' => 'A globally recognized 240-credit UK Level 4 & 5 undergraduate qualification providing direct entry into the final year of a British BSc/BA (Hons) degree.',
                'overview' => "The Higher National Diploma (HND) in Business Management at GIEC Colombo 03 delivers practical, assignment-led UK undergraduate education without rote memorization exams. Students analyze real Sri Lankan and multinational enterprises while developing strategic financial, marketing, and operational decision-making capabilities.\n\nUpon completing Level 4 and Level 5 (240 credits), graduates qualify directly for Final-Year (Level 6) BSc (Hons) Top-Up progression in Sri Lanka, the UK, Australia, or Malaysia.",
                'modules' => [
                    [
                        'title' => 'Unit 1: Business & the Business Environment (Level 4)',
                        'description' => 'Macroeconomic forces, legal structures, stakeholder governance, and competitive market analysis.',
                    ],
                    [
                        'title' => 'Unit 2: Marketing Processes & Planning (Level 4)',
                        'description' => 'Consumer behavior, digital omnichannel strategy, brand positioning, and campaign ROI modeling.',
                    ],
                    [
                        'title' => 'Unit 3: Management Accounting & Financial Decision Making (Level 4)',
                        'description' => 'Budgeting, variance analysis, investment appraisal, and financial statement interpretation.',
                    ],
                    [
                        'title' => 'Unit 4: Organizational Behavior & Leadership Dynamics (Level 5)',
                        'description' => 'Culture transformation, motivation frameworks, talent retention, and high-performing teams.',
                    ],
                    [
                        'title' => 'Unit 5: Global Operations & Supply Chain Strategy (Level 5)',
                        'description' => 'Lean operations, international logistics, procurement risk, and quality management systems.',
                    ],
                    [
                        'title' => 'Unit 6: Undergraduate Business Research Project (Level 5)',
                        'description' => 'Guided empirical research dissertation solving a live industry problem for a partner organization.',
                    ],
                ],
                'entry_requirements' => [
                    '2 Passes at G.C.E. A/L (any stream) or recognized Foundation Diploma.',
                    'G.C.E. O/L Credit pass in English & Mathematics (or GIEC Diploma in English).',
                    'Mature applicants (21+) with 2+ years of supervisory work experience considered via RPL.',
                ],
                'student_packages' => [
                    [
                        'name' => 'Standard Undergraduate Track',
                        'fee' => 'LKR 320,000',
                        'badge' => 'Semester Plan',
                        'features' => [
                            'Full 24-month Level 4 & Level 5 tuition at Galle Road Campus',
                            'Dedicated academic assignment supervisor & plagiarism check access',
                            'Harvard Business & e-Library digital journal credentials',
                            'Payable across 4 manageable semester installments',
                        ],
                    ],
                    [
                        'name' => 'Fast-Track 18-Month Package',
                        'fee' => 'LKR 365,000',
                        'badge' => 'Accelerated',
                        'features' => [
                            'Compressed 18-month delivery with weekend & evening executive clinics',
                            '1-on-1 dissertation & assignment drafting mentorship',
                            'Career readiness workshops & LinkedIn portfolio coaching',
                            'Priority transition into BSc (Hons) Top-Up cohort',
                        ],
                    ],
                    [
                        'name' => 'Complete UK Certification & Top-Up Bridge',
                        'fee' => 'LKR 430,000',
                        'badge' => 'All-Inclusive',
                        'features' => [
                            'Covers full tuition + UK awarding body registration & certification fees',
                            'Guaranteed UK university credit transfer advisory & SOP support',
                            'Complimentary Business Communication Certificate module',
                            '12-month zero-interest monthly installment schedule',
                        ],
                    ],
                ],
                'is_featured' => true,
                'is_published' => true,
            ],
            [
                'department_slug' => 'information-technology',
                'title' => 'Diploma in Information Technology & Software Engineering',
                'slug' => 'diploma-in-information-technology-software-engineering',
                'level' => 'Diploma',
                'formats' => ['On-Campus', 'Online'],
                'duration' => '12 Months',
                'next_intake' => 'March & August Intakes',
                'accreditation' => 'UK RQF Level 4 Equivalent Industry Diploma',
                'summary' => 'A hands-on software engineering and IT systems diploma covering full-stack web applications, relational databases, cloud deployment, and agile delivery.',
                'overview' => "Built for aspiring software engineers, IT analysts, and career switchers, the Diploma in Information Technology & Software Engineering bridges core computer science principles with modern production tooling.\n\nStudents graduate with a GitHub portfolio of deployed web applications, SQL database schemas, RESTful APIs, and UX prototypes ready for junior developer roles or BSc Computing progression.",
                'modules' => [
                    [
                        'title' => 'Module 1: Computer Systems, Networking & Linux Fundamentals',
                        'description' => 'Operating systems, TCP/IP networking, cybersecurity hygiene, and command-line productivity.',
                    ],
                    [
                        'title' => 'Module 2: Relational Database Engineering with MySQL',
                        'description' => 'ER modeling, normalization, complex SQL joins, indexing strategies, and transactional integrity.',
                    ],
                    [
                        'title' => 'Module 3: Modern Web Interfaces (HTML5, Tailwind CSS & JavaScript)',
                        'description' => 'Responsive UI engineering, accessible semantic layouts, and reactive frontend state.',
                    ],
                    [
                        'title' => 'Module 4: Backend Engineering with PHP & Laravel',
                        'description' => 'MVC architecture, Eloquent ORM, authentication, validation, REST APIs, and automated testing.',
                    ],
                    [
                        'title' => 'Module 5: Agile DevOps & Capstone Production Project',
                        'description' => 'Git workflows, cloud deployment, performance profiling, and live industry panel demo.',
                    ],
                ],
                'entry_requirements' => [
                    'G.C.E. O/L qualification with passes in English and Mathematics.',
                    'No prior coding experience required (foundational bootcamp included in Week 1).',
                    'Personal laptop recommended (Colombo 03 lab workstations available for On-Campus students).',
                ],
                'student_packages' => [
                    [
                        'name' => 'Standard Developer Track',
                        'fee' => 'LKR 125,000',
                        'badge' => 'Core Tuition',
                        'features' => [
                            '12 months instructor-led coding labs & guided projects',
                            'GitHub portfolio code reviews by senior software engineers',
                            'Full access to GIEC Colombo 03 IT lab & cloud sandbox',
                            'GIEC Accredited Diploma Certificate & Grade Transcript',
                        ],
                    ],
                    [
                        'name' => 'Complete Career & UK Certification Package',
                        'fee' => 'LKR 165,000',
                        'badge' => 'Job-Ready',
                        'features' => [
                            'Full UK-endorsed qualification registration & external assessment',
                            'Technical CV clinic, mock coding interviews & internship referrals',
                            'AWS / Cloud deployment workshop & domain hosting starter credit',
                            'Flexible 6-month installment plan available',
                        ],
                    ],
                ],
                'is_featured' => true,
                'is_published' => true,
            ],
            [
                'department_slug' => 'business-management',
                'title' => 'Certificate in Business Communication & Corporate Etiquette',
                'slug' => 'certificate-in-business-communication-corporate-etiquette',
                'level' => 'Certificate',
                'formats' => ['Online'],
                'duration' => '8 Weeks (Live Online)',
                'next_intake' => 'Monthly Weekend Cohorts',
                'accreditation' => 'GIEC Executive Skills & UK CPD Aligned',
                'summary' => 'A sharp, 8-week live online executive certificate designed to elevate business writing, executive presence, virtual meeting leadership, and global corporate etiquette.',
                'overview' => "Created for ambitious professionals, customer success leads, and graduating students entering multinational organizations, this 100% live online certificate transforms how you write, present, and persuade in international workplaces.\n\nEach interactive Saturday session combines real-world corporate simulations, email/proposal teardowns, and personalized executive feedback.",
                'modules' => [
                    [
                        'title' => 'Week 1–2: High-Impact Business Writing & Proposals',
                        'description' => 'Executive summaries, persuasive client emails, meeting minutes, and concise briefing memos.',
                    ],
                    [
                        'title' => 'Week 3–4: Boardroom & Virtual Presentation Mastery',
                        'description' => 'Structuring executive slide narratives, vocal authority on Zoom/Teams, and handling tough Q&A.',
                    ],
                    [
                        'title' => 'Week 5–6: Cross-Cultural Corporate Etiquette & Diplomacy',
                        'description' => 'International business protocol, dining and networking etiquette, and stakeholder tact.',
                    ],
                    [
                        'title' => 'Week 7–8: Negotiation Simulation & Executive Assessment',
                        'description' => 'Live client pitch simulation, negotiation role-play, and formal certificate evaluation.',
                    ],
                ],
                'entry_requirements' => [
                    'Working knowledge of English (Intermediate / Level 5+ recommended).',
                    'Stable internet connection with webcam and microphone for live online workshops.',
                ],
                'student_packages' => [
                    [
                        'name' => 'Individual Executive Package',
                        'fee' => 'LKR 32,000',
                        'badge' => '100% Online',
                        'features' => [
                            '8 weeks of live weekend masterclasses + on-demand replays',
                            'Downloadable Corporate Email & Proposal Template Toolkit',
                            'Personalized 1-on-1 communication audit & feedback report',
                            'Verifiable Digital Certificate for LinkedIn & CV',
                        ],
                    ],
                    [
                        'name' => 'Corporate Sponsored / Fast-Track Package',
                        'fee' => 'LKR 45,000',
                        'badge' => 'CPD Certified',
                        'features' => [
                            'UK CPD-aligned official hardcopy & digital certificate',
                            'Two private executive presentation coaching sessions',
                            'Company-invoiced billing option for HR / L&D teams',
                        ],
                    ],
                ],
                'is_featured' => false,
                'is_published' => true,
            ],
            [
                'department_slug' => 'business-management',
                'title' => 'BSc (Hons) Top-Up in International Business',
                'slug' => 'bsc-hons-top-up-international-business',
                'level' => 'Undergraduate',
                'formats' => ['Hybrid'],
                'duration' => '12 Months (Final Year Level 6)',
                'next_intake' => 'March & September Intakes',
                'accreditation' => 'UK Level 6 Honours Degree Pathway',
                'summary' => 'Convert your HND or equivalent 240-credit Level 5 qualification into a full British Honours degree in just 12 months through GIEC’s flexible hybrid academic model.',
                'overview' => "The BSc (Hons) Top-Up in International Business enables HND, ABE Level 5, and Advanced Diploma holders to earn a full UK Honours undergraduate degree without leaving Sri Lanka or pausing their career.\n\nCombining Colombo 03 weekend seminars with global online research supervision, the curriculum sharpens strategic competitiveness, international trade policy analysis, and capstone dissertation research.",
                'modules' => [
                    [
                        'title' => 'Module 1: Global Strategic Management & Competitive Advantage',
                        'description' => 'Corporate strategy formulation, M&A evaluation, and global market entry frameworks.',
                    ],
                    [
                        'title' => 'Module 2: International Trade, Finance & Risk Governance',
                        'description' => 'Foreign exchange exposure, cross-border trade agreements, and international capital markets.',
                    ],
                    [
                        'title' => 'Module 3: Contemporary Issues in Global Digital Commerce',
                        'description' => 'Platform business models, AI-enabled operations, and international ESG compliance.',
                    ],
                    [
                        'title' => 'Module 4: Cross-Cultural Leadership & Change Management',
                        'description' => 'Leading distributed international teams and executing large-scale organizational change.',
                    ],
                    [
                        'title' => 'Module 5: Honours Undergraduate Dissertation (10,000 Words)',
                        'description' => 'Independent primary research supervised weekly by a doctoral-qualified UK academic advisor.',
                    ],
                ],
                'entry_requirements' => [
                    'Completed UK Level 5 / HND in Business (240 credits) or equivalent recognized Advanced Diploma.',
                    'IELTS 6.0 equivalent or GIEC Diploma in English (UK) completion.',
                ],
                'student_packages' => [
                    [
                        'name' => 'Standard Hybrid Degree Track',
                        'fee' => 'LKR 480,000',
                        'badge' => 'Hybrid Model',
                        'features' => [
                            'Full 12-month Level 6 tuition (Colombo 03 weekend clinics + live online)',
                            'Dedicated UK-experienced dissertation research supervisor',
                            'Access to Turnitin, ProQuest & international journal databases',
                            'Quarterly installment plan across 4 payments',
                        ],
                    ],
                    [
                        'name' => 'Complete UK Honours Certification Package',
                        'fee' => 'LKR 560,000',
                        'badge' => 'All Fees Included',
                        'features' => [
                            'Includes UK awarding university registration, assessment & graduation fees',
                            '1-on-1 academic research methodology & statistical coaching',
                            'Postgraduate MBA / MSc application & reference advisory',
                            '8-month zero-interest installment facility',
                        ],
                    ],
                ],
                'is_featured' => true,
                'is_published' => true,
            ],
            [
                'department_slug' => 'business-management',
                'title' => 'Postgraduate Diploma in Strategic Management & Leadership',
                'slug' => 'postgraduate-diploma-strategic-management-leadership',
                'level' => 'Postgraduate',
                'formats' => ['Online', 'Hybrid'],
                'duration' => '9–12 Months (120 UK Level 7 Credits)',
                'next_intake' => 'January, May & September Intakes',
                'accreditation' => 'UK RQF Level 7 (MBA Top-Up Pathway)',
                'summary' => 'A 120-credit UK Level 7 executive postgraduate qualification tailored for managers and founders, offering direct progression to a UK MBA Top-Up (60-credit dissertation).',
                'overview' => "Engineered for mid-to-senior managers, entrepreneurs, and functional specialists, the Postgraduate Diploma in Strategic Management & Leadership delivers Masters-level strategic rigor in a flexible Online or Hybrid executive schedule.\n\nGraduates earn 120 UK Level 7 credits, unlocking fast-track Stage 2 entry into an accredited UK MBA Top-Up (dissertation only) within 4 to 6 additional months.",
                'modules' => [
                    [
                        'title' => 'Module 1: Strategic Management & Corporate Governance (20 Credits)',
                        'description' => 'Board-level strategic planning, ESG stewardship, and long-horizon competitive positioning.',
                    ],
                    [
                        'title' => 'Module 2: Strategic Leadership & Executive Decision Making (20 Credits)',
                        'description' => 'Transformational leadership, stakeholder alignment, and crisis decision frameworks.',
                    ],
                    [
                        'title' => 'Module 3: Corporate Finance & Strategic Performance (20 Credits)',
                        'description' => 'Capital allocation, corporate valuation, balanced scorecards, and enterprise risk.',
                    ],
                    [
                        'title' => 'Module 4: Strategic Marketing & Global Brand Architecture (20 Credits)',
                        'description' => 'Global expansion strategies, omnichannel brand equity, and B2B growth systems.',
                    ],
                    [
                        'title' => 'Module 5: Entrepreneurship, Innovation & Applied Research Methods (40 Credits)',
                        'description' => 'Design thinking, venture scaling, and Level 7 research proposal preparation for MBA Top-Up.',
                    ],
                ],
                'entry_requirements' => [
                    'Recognized Bachelor’s Degree (any discipline) OR UK Level 6 Diploma.',
                    'Applicants aged 25+ with 5+ years of managerial experience may qualify via executive entry review.',
                    'Proficiency in academic English writing.',
                ],
                'student_packages' => [
                    [
                        'name' => 'Standard Postgraduate Online Track',
                        'fee' => 'LKR 340,000',
                        'badge' => 'Live Online',
                        'features' => [
                            'Full 120-credit Level 7 tuition delivered via evening & weekend sessions',
                            'Harvard-style executive case studies & peer leadership roundtables',
                            'Assignment critique & Level 7 academic writing support',
                            'Flexible 4-installment payment schedule',
                        ],
                    ],
                    [
                        'name' => 'Executive Hybrid + MBA Progression Package',
                        'fee' => 'LKR 415,000',
                        'badge' => 'MBA Pathway',
                        'features' => [
                            'Includes UK awarding body registration & Level 7 Diploma certification',
                            'Colombo 03 executive boardroom workshops & alumni networking',
                            'Dedicated MBA Top-Up dissertation proposal mentorship',
                            'Guaranteed credit-transfer guidance to UK partner universities',
                        ],
                    ],
                ],
                'is_featured' => true,
                'is_published' => true,
            ],
            [
                'department_slug' => 'hospitality-tourism',
                'title' => 'Diploma in International Hospitality & Tourism Operations',
                'slug' => 'diploma-in-international-hospitality-tourism-operations',
                'level' => 'Diploma',
                'formats' => ['On-Campus'],
                'duration' => '12 Months (Including Industry Placement)',
                'next_intake' => 'February & July Intakes',
                'accreditation' => 'UK & International Hospitality Council Aligned',
                'summary' => 'A practical on-campus Colombo 03 diploma combining five-star hotel operations, food & beverage management, and international tourism curation with guaranteed hotel exposure.',
                'overview' => "Sri Lanka's resurgent hospitality and luxury tourism sector demands managers trained to international five-star service benchmarks. This immersive On-Campus Diploma at GIEC Colombo 03 blends classroom management theory with live luxury hotel site visits, guest-service simulations, and a structured 3-month industry internship.\n\nGraduates enter supervisory roles in star-class resorts, boutique properties, cruise lines, and destination management companies across Sri Lanka, the Maldives, and the Middle East.",
                'modules' => [
                    [
                        'title' => 'Module 1: Front Office, Rooms Division & Revenue Management',
                        'description' => 'PMS reservation systems, yield pricing strategies, VIP guest relations, and concierge standards.',
                    ],
                    [
                        'title' => 'Module 2: Food & Beverage Service, Hygiene & Banqueting',
                        'description' => 'Menu engineering, HACCP food safety, luxury event logistics, and cost control.',
                    ],
                    [
                        'title' => 'Module 3: Global Destination Tourism & Eco-Hospitality',
                        'description' => 'Sustainable tourism design, airline ticketing fundamentals, and tour itinerary curation.',
                    ],
                    [
                        'title' => 'Module 4: Hospitality Business English & Guest Psychology',
                        'description' => 'Cross-cultural service excellence, complaint resolution, and professional hospitality English.',
                    ],
                    [
                        'title' => 'Module 5: 3-Month Luxury Hotel Industry Placement',
                        'description' => 'Supervised practical attachment at partner 4-star & 5-star properties in Colombo and Galle.',
                    ],
                ],
                'entry_requirements' => [
                    'G.C.E. O/L qualification (6 passes including English) or G.C.E. A/L appearance.',
                    'Strong interpersonal enthusiasm for service, travel, and guest hospitality.',
                    'Personal interview with the GIEC Hospitality Faculty Panel.',
                ],
                'student_packages' => [
                    [
                        'name' => 'Standard On-Campus Track',
                        'fee' => 'LKR 145,000',
                        'badge' => 'Colombo 03',
                        'features' => [
                            '9 months intensive on-campus lectures & service lab simulations',
                            '3-month supervised hospitality placement assistance',
                            'Complimentary Hospitality English coaching module',
                            'GIEC Accredited Diploma Certificate & Placement Logbook',
                        ],
                    ],
                    [
                        'name' => 'Complete International Career Package',
                        'fee' => 'LKR 185,000',
                        'badge' => 'Overseas Ready',
                        'features' => [
                            'Full tuition + UK hospitality body registration & external certification',
                            'Guaranteed interview placement with Colombo 5-star & Maldives partners',
                            'Professional hospitality grooming kit & international CV workshop',
                            '6-month interest-free installment payment plan',
                        ],
                    ],
                ],
                'is_featured' => false,
                'is_published' => true,
            ],
        ];

        $seededPrograms = [];
        foreach ($programs as $programData) {
            $departmentSlug = $programData['department_slug'];
            unset($programData['department_slug']);

            $programData['department_id'] = $departments[$departmentSlug]->id;

            $seededPrograms[$programData['slug']] = Program::updateOrCreate(
                ['slug' => $programData['slug']],
                $programData
            );
        }

        if (Inquiry::count() === 0) {
            Inquiry::create([
                'program_id' => $seededPrograms['diploma-in-english-uk']->id,
                'full_name' => 'Amaya Perera',
                'email' => 'amaya.perera@example.com',
                'phone' => '+94 77 412 8890',
                'preferred_format' => 'On-Campus',
                'selected_package' => 'Complete UK Certification Package',
                'message' => 'Interested in the upcoming weekend batch at the Galle Road Colombo 03 campus. Can I pay in 3 installments?',
                'status' => 'new',
            ]);

            Inquiry::create([
                'program_id' => $seededPrograms['higher-national-diploma-business-management']->id,
                'full_name' => 'Kavindu Jayawardena',
                'email' => 'kavindu.j@example.com',
                'phone' => '+94 71 884 5512',
                'preferred_format' => 'Hybrid',
                'selected_package' => 'Complete UK Certification & Top-Up Bridge',
                'message' => 'I completed my A/Ls in Commerce and want to fast-track into a UK degree.',
                'status' => 'contacted',
            ]);

            Inquiry::create([
                'program_id' => $seededPrograms['london-english-proficiency-program-levels-1-10']->id,
                'full_name' => 'Fathima Nazeer',
                'email' => 'fathima.nazeer@example.com',
                'phone' => '+94 76 309 1144',
                'preferred_format' => 'Online',
                'selected_package' => '3-Level Progression Bundle',
                'message' => 'Would like to schedule my 20-minute diagnostic placement check this week.',
                'status' => 'enrolled',
            ]);
        }
    }
}
