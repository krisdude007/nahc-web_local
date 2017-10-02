<?php

use common\models\User;
use yii\db\Migration;

class m170614_213246_data extends Migration
{
    public function up()
    {
        $ts = time();

        $this->batchInsert('provider',
            ['name', 'benefit_email', 'benefit_phone', 'created_at', 'updated_at'],
            [
                ['WellCard Savings',            'tbd@chi.com',                      '877-827-8680',     $ts, $ts],

                ['Healthgrades',                'tbd@healthgrades.com',             'N/A',              $ts, $ts],
                ['Generali Global Assistance',  'tbd@meridian.com',                 'N/A',              $ts, $ts],

                ['Healthcare Bluebook',         'support@healthcarebluebook.com',   '800-341-0504',     $ts, $ts],
                ['MeMD',                        'helpdesk@memd.me',                 '855-636-3669',     $ts, $ts],
                ['Karis Group',                 'help@karis360.com',                '512-292-9560',     $ts, $ts],

                ['Healthcare Advocates',        'info@healthcareadvocates.com',     '215-735-7738',     $ts, $ts],
                ['AnyDoctor',                   'help@anydoctor.com',               '855-276-1354',     $ts, $ts],

                ['Catlin',                      'NA',                               'NA',               $ts, $ts],
                ['OptimumVision',               'NA',                               'NA',               $ts, $ts],
                ['RSLI',                        'NA',                               'NA',               $ts, $ts],
            ]
        );

        $this->batchInsert('membership',
            ['ext_id', 'name', 'description', 'level', 'price', 'created_at', 'updated_at'],
            [
                [17454, 'Basic',    'Just the Basics',      1,   0,      $ts, $ts],
                [16978, 'Bronze',   'The Basics & More',    2,   795,    $ts, $ts],
                [16980, 'Silver',   'Adds the Advocate',    3,   1495,   $ts, $ts],
                [16983, 'Gold',     'Soup to Nuts',         4,   1995,   $ts, $ts],
            ]
        );

        $this->batchInsert('membership_benefit',
            ['provider_id', 'name', 'long_name', 'icon', 'email', 'phone', 'url', 'benefit_mem_id', 'group_data', 'other_ref', 'created_at', 'updated_at', 'description', 'detail', 'features', 'features2'],
            [
                [1, 'RX Savings Card',  'Prescription Drug Savings Card',      'icon-card',            'tbd@chi.com',                      '877-827-8680',     'http://www.wellcardsavings.com',                                              true,   'NAHC',     null,    $ts, $ts,
                    'Save hundreds of dollars per year at thousands of name-brand pharmacies nationwide',
                    'The NAHC Prescription Drug Savings Card is free and gives you and your family immediate discounts on prescription drugs at over 59,000 pharmacies nationwide.',
                    implode('::', [
                        'A Free Prescription Drug Discount Card',
                        'Discounts at over 59,000 pharmacies nationwide',
                        'Access to on-line pharmacy look up',
                        'Can be used by your entire family',
                        'Immediate prescription discounts on payment',
                    ]),
                    implode('::', [
                        'No monthly fees, no costs for use of the card',
                        'Immediate savings, averaging 50% or more',
                        'Discounts at pharmacies convenient to you',
                        'Lower family’s out-of-pocket prescription costs',
                        'Do not have to wait, get immediate cost savings',
                    ]),
                ],
                [1, 'Savings Network',  'Medical Provider Savings Network',         'icon-dmpo',        'tbd@chi.com',                      '877-827-8680',     'http://www.wellcardsavings.com',                                              true,   'NAHC',     null,    $ts, $ts,
                    'Save thousands of dollars per year at thousands of medical providers nationwide',
                    'NAHC Members get access to a nationwide network of doctors and other healthcare providers who provide immediate discounts at time of service for Members paying cash.',
                    implode('::', [
                        'Free Member Access to the provider discount network',
                        'Discounts at over 59,000 pharmacies nationwide',
                        'Access to on-line pharmacy look up',
                        'Can be used by your entire family',
                        'Immediate prescription discounts on payment',
                    ]),
                    implode('::', [
                        'Lowers doctor',
                        'Immediate savings, averaging 50% or more',
                        'Discounts at pharmacies convenient to you',
                        'Lower family’s out-of-pocket prescription costs',
                        'Do not have to wait, get immediate cost savings',
                    ]),
                ],

                [2, 'Quality Reports',  'Doctor & Hospital Quality Reports',         'icon-qual',         'tbd@healthgrades.com',             null,               'http://healthgrades.com',                          false,  null,       null,    $ts, $ts,
                    'Ratings and reviews for thousands of doctors and healthcare facilities nationwide',
                    'NAHC Members get access to on-line doctor and hospital reviews and quality ratings nationwide, so our Members can make informed decisions when choosing the best provider for their medical needs.',
                    implode('::', [
                        'Search on-line to find a doctor near you or nationwide',
                        'Search on-line to find a dentist near you or nationwide',
                        'See on-line reviews for a doctor',
                        'Determine which insurance is accepted by the doctor',
                    ]),
                    implode('::', [
                        'See a star rating system for doctors and dentists',
                        'Identify a doctor or dentist by medical practice specialty',
                        'Be able to submit an on-line review of a doctor',
                        'Review the doctor’s education and background',
                    ]),
                ],
                [3, 'Medical Travel Assistance',    'Worldwide Medical Travel Assistance',        'icon-mta',          'tbd@meridian.com',                 'N/A',              'tbd',                                              true,   null,       null,    $ts, $ts,
                    'Complete peace-of-mind when traveling with coverage that takes care of hundreds of needs',
                    'NAHC Members get access to emergency medical service when traveling domestically or worldwide.',
                    implode('::', [
                        '24/7 emergency medical evacuation on traveling',
                        'Providing real-time assistance anywhere in the world',
                        'Provides Air Ambulance service if needed',
                        'Provides turnkey logistical support for all types of evacuations',
                    ]),
                    implode('::', [
                        'Emergency medical transportation worldwide',
                        '35+ multilingual assistance centers worldwide',
                        'Assistance with medical search and approvals',
                        'Coordination of return travel to U.S. in medical emergency',
                    ]),
                ],

                [4, 'Pricing Comparison',   'Healthcare Pricing Reports & Comparisons',  'icon-comp',    'support@healthcarebluebook.com',   '800-341-0504',     'http://www.healthcarebluebook.com/cc/nahc',        true,   null,       null,    $ts, $ts,
                    'Compare and shop for virtually any healthcare service online and instantly save',
                    'NAHC Members get access to on-line doctor and hospital pricing nationwide, so our Members can find the best most cost-effective solutions for their medical needs.',
                    implode('::', [
                        'See what doctors and hospitals typically charge',
                        'Find the typical cost for any medical procedure',
                        'Identify doctors with the best reputation and best prices',
                        'See what a surgical procedure will cost',
                    ]),
                    implode('::', [
                        'Stop over paying for healthcare',
                        'Learn what a Fair Price is for any medical procedure',
                        'Identify the best quality doctor to got to for surgery',
                        'Learn what different hospitals charge for same procedure',
                    ]),
                ],
                [5, 'Telemedicine Services',    '24/7 Telemedicine Access',            'icon-tele',            'helpdesk@memd.me',                 '855-636-3669',     'https://www.memd.me/group/nahc',                   true,   'NAHC',     null,    $ts, $ts,
                    '24/7 phone readiness to assist you with any medical question or need you might have',
                    'NAHC Members get 24/7 on-line access, 365 days a year to medical providers anywhere in the U.S., and from the convenience of one’s home, office, or even on vacation.',
                    implode('::', [
                        'See a medical professional on-line, immediately',
                        'Access a provider on-line from home, work, vacation',
                        'No need to set an appointment to see a provider',
                        'For most ailments, you get diagnosis and treatment on-line',
                        'Speak with a board-certified licensed medical provider',
                    ]),
                    implode('::', [
                        'When medically necessary, get an e-prescription',
                        '24/7 On-line access to a medical professional',
                        'More affordable than a doctor’s visit',
                        'Secure on-line access, with confidential diagnoses',
                        'Costs less than most co-pays',
                    ]),
                ],
                [6, 'Patient Advocacy', 'Personal Healthcare Advocacy',                 'icon-adv',        'help@karis360.com',                '512-292-9560',     'https://thekarisgroup.com/karis360-members/',      true,   null,       null,    $ts, $ts,
                    'Finally a healthcare advocate and consultant who works just for you',
                    'NAHC Members get access to a personal healthcare advocate you can advise and lobby on behalf of the Member; on costs for healthcare services, best insurance and understanding the benefits, and medical billing.',
                    implode('::', [
                        'Get help on understanding insurance plans & benefits',
                        'Access a physician referral service',
                        'Find tips on preparing for surgery or hospitalization',
                        'Get costs estimates for surgery before you go in for surgery',
                    ]),
                    implode('::', [
                        'Get help on finding the right physician specialist',
                        'Medical Bill Auditing and Dispute Services',
                        'More affordable than a doctor’s visit',
                        'Get estimates on prescription costs and generic drugs',
                        'Get advice on the best hospital for a specific specialty',
                    ]),
                ],

                [7, 'Premium Advocacy', 'Premium Personal Healthcare Advocacy',         'icon-advp',        'info@healthcareadvocates.com',     '215-735-7738',     'http://healthcareadvocates.com',                   true,   null,       null,    $ts, $ts,
                    'Enhanced personal services from your very own personal healthcare advisor',
                    'NAHC Members get access to a personal healthcare advocate you can advise and lobby on behalf of the Member; on costs for healthcare services, best insurance and understanding the benefits, and medical billing.',
                    implode('::', [
                        'Get help on understanding insurance plans & benefits',
                        'Access a physician referral service',
                        'Find tips on preparing for surgery or hospitalization',
                        'Get costs estimates for surgery before you go in for surgery',
                    ]),
                    implode('::', [
                        'Get help on finding the right physician specialist',
                        'Medical Bill Auditing and Dispute Services',
                        'More affordable than a doctor’s visit',
                        'Get estimates on prescription costs and generic drugs',
                        'Get advice on the best hospital for a specific specialty',
                    ]),
                ],
                [8, 'Provider Concierge',   'Concierge for Healthcare Services',               'icon-pc',       'help@anydoctor.com',                      '855-276-1354',               null,                                               true,   'NAHC',     null,    $ts, $ts,
                    'Your advocate negotiates a cash price for any non-contracted provider on your behalf',
                    'Have an advocate negotiate with doctors and other healthcare providers and determine a price for you, before you visit the doctor’s office.',
                    implode('::', [
                        'Get help finding the right doctor for a specialized procedure',
                        'Get help determining a discounted cash price for a doctor’s visit',
                        'Reduce your costs of primary care visits',
                        'Find a hospital best suited for your surgery',
                    ]),
                    implode('::', [
                        'Get help negotiating the cost of a doctor visit',
                        'Have someone find you the best doctor for a specialty',
                        'Have someone determine if there are hidden costs',
                        'Get help negotiating the cost of surgery',
                    ]),
                ],
            ]
        );

        $this->batchInsert('membership_benefit_map',
            ['membership_id', 'benefit_id', 'created_at', 'updated_at'],
            [
                [1, 1, $ts, $ts],
                [1, 2, $ts, $ts],

                [2, 1, $ts, $ts],
                [2, 2, $ts, $ts],
                [2, 3, $ts, $ts],
                [2, 4, $ts, $ts],

                [3, 1, $ts, $ts],
                [3, 2, $ts, $ts],
                [3, 3, $ts, $ts],
                [3, 4, $ts, $ts],
                [3, 5, $ts, $ts],
                [3, 6, $ts, $ts],
                [3, 7, $ts, $ts],

                [4, 1, $ts, $ts],
                [4, 2, $ts, $ts],
                [4, 3, $ts, $ts],
                [4, 4, $ts, $ts],
                [4, 5, $ts, $ts],
                [4, 6, $ts, $ts],
                [4, 7, $ts, $ts],
                [4, 8, $ts, $ts],
                [4, 9, $ts, $ts],
            ]
        );

        $this->batchInsert('product',
            ['page_order', 'provider_id', 'name', 'short_name', 'img', 'icon', 'created_at', 'updated_at', 'description', 'benefits'],
            [
                [7, 9,  'Accidental Death & Dismemberment',   'AD&D',  'products-4.jpg',    'icon-add', $ts, $ts,
                    'If something critical were to arise, our coverage will take care of any potential need for you and your family.',
                    implode('::', [
                        'Coverage for accidental death or loss of limb',
                        'Coverage of $25,000, $100,000, or $250,000',
                        'One time payment, to your beneficiary',
                        'Payout for loss of sight, speech, or hearing',
                        'Coverage beginning as low as $3 month',
                    ])
                ],

                [4, 9,  'Critical Illness Insurance',         'CI',   'products-4.jpg',    'icon-ci', $ts, $ts,
                    'Don’t let a critical illness paralyze your ability to pay out-of-pocket medical costs and non-medical costs associated with costly treatments.',
                    implode('::', [
                        'Guaranteed Issue, No Medical Exams',
                        'No Restrictions on how you spend the money',
                        'Coverage options of $5,000, $10,000, $25,000',
                        'One time payment, paid directly to you',
                        'Coverage beginning at less than $20 month',
                    ]),
                ],
                [3, 9,  'Accident Medical Expenses',    'AME',  'products-1.jpg',    'icon-ame',     $ts, $ts,
                    'Get the real protection you need to pay your high out-of-pocket medical bills following an accident.',
                    implode('::', [
                        'Gap coverage to help with high deductibles',
                        'You are covered 24/7, on or off the job',
                        '$10,000 coverage of air ambulance costs',
                        '$5,000 AD&D Coverage included ',
                        'Coverage beginning at less than $1 per day',
                    ]),
                ],
                [2, 9,  'Accident Hospital Indemnity',        'AHI',  'products-4.jpg',    'icon-ahi', $ts, $ts,
                    'Getting $500 per day makes hospital confinement costs more manageable.',
                    implode('::', [
                        'Gap coverage to help with high deductibles',
                        'No restrictions on how you spend the money',
                        '$500 per day for up to 30 days',
                        '$5,000 AD&D Coverage included',
                        '$10,000 coverage of air ambulance costs',
                        'Coverage beginning at less than $2 per week',
                    ]),
                ],
                [1, 9,  'Accident Disability Insurance',      'ADI',  'products-1.jpg',    'icon-adi',  $ts, $ts,
                    'Losing your ability to work doesn\'t have to make you lose your ability to provide for your family.',
                    implode('::', [
                        'No restrictions on how you spend the money',
                        'Funds paid directly to you',
                        'Up to $500 benefit/week for up to 6 months',
                        '$5,000 AD&D Coverage included',
                        '$10,000 coverage of air ambulance costs',
                        'Coverage beginning at less than $5 per week',
                    ]),
                ],
                [6, 11, 'Dental Insurance',                   'Dental',   'products-3.jpg',    'icon-dsp', $ts, $ts,
                    'Visits to the dentist create more than a healthy smile, they create a healthy you.  You should not have to put off going to the dentist because of budget concerns.',
                    implode('::', [
                        'See any Dentist of your choice',
                        'No waiting periods; good from Day 1',
                        'Can lower out-of-pocket expenses',
                        'Covers from cleaning to oral surgery',
                        'Coverage beginning at less than $10 week',
                    ]),
                ],
                [5, 10, 'Vision Insurance',                   'VSP',  'products-2.jpg',    'icon-vsp',   $ts, $ts,
                    'Save over $300 on your first trip to the eye doctor for an exam and eyewear.',
                    implode('::', [
                        'Comprehensive well vision plan for only $10',
                        'Free contact lenses each year ',
                        '$130 towards frames every 2 years ',
                        'Discount on laser vision correction ',
                        'Coverage beginning at less than $5 per week',
                    ]),
                ],
            ]
        );

        $this->batchInsert('product_faq',
            ['product_id', 'num', 'created_at', 'updated_at', 'content'],
            [
//                [1, 1, $ts, $ts, ''],
//                [1, 2, $ts, $ts, ''],
//                [1, 3, $ts, $ts, ''],
//                [1, 4, $ts, $ts, ''],
//                [1, 5, $ts, $ts, ''],
//                [1, 6, $ts, $ts, ''],

                // ADD
                [1, 1, $ts, $ts, 'In the unfortunate event that an insured person suffers a dismembered limb or passes away due to a covered accident, an AD&D insurance policy will pay the elected benefit amount based on the schedule of benefits. Per the Center for Disease Control and Prevention, Accidental deaths are the fifth leading cause of death in the United States, so obtaining AD&D insurance can protect your loved ones. In the event of an accidental death, benefits are payable to the beneficiary.  In addition to covering accidental death, AD&D policies pay if the insured suffers an accidental dismemberment.'],
                [1, 2, $ts, $ts, 'Accidents can happen in an instant, but the consequences can last a lifetime. Accidental death and dismemberment (AD&D) insurance gives you added financial security in sudden and tragic circumstances. AD&D Insurance helps safeguard your assets against the impact a serious injury or accidental death could have on them. It pays a benefit directly to you (or your named beneficiary) in the event of a covered accident, giving you access to the additional security you would need if a catastrophe affected your life.'],
                [1, 3, $ts, $ts, 'Because it is a safe guard against the unforeseen – a severe accident or even death – most do not think they need AD&D Insurance. But it is becoming an increasingly more desired insurance benefit to protect individuals and their family against the high medical bills associated with severe accidents. Some high paying professional jobs, company owners, and similar professional folks may have life insurance with riders that pay their beneficiaries in case of the policyholders for accidental death.'],
                [1, 4, $ts, $ts, 'Some of the covered accidents include traffic accidents, exposure, homicide, falls, heavy equipment accidents and drowning. Our accidental death & dismemberment plan provides 24-hour coverage no matter where a covered accident occurs, whether at work, home or away. AD&D applies in the event of a covered injury, paralysis or death resulting from a covered accident, with three plan options providing payouts at $25,000; $100,000; or $250,000 depending on the policy obtained and premium payment.'],
                [1, 5, $ts, $ts, 'Death by illness is excluded as well as death by “malfunction of the body,” such as someone suffering a stroke or heart attack while driving. If the heart attack or stroke occurred before the accident and the accident resulted from that bodily malfunction, the policy would not pay.   AD&D insurance coverage has some important limitations. For example, many AD&D insurance policies do not pay benefits if the insured dies during surgery, has a mental or physical illness, has a bacterial infection or hernia or dies as the result of a drug overdose.'],
                [1, 6, $ts, $ts, ''],

                // CI
                [2, 1, $ts, $ts, 'In the event of the first diagnosis of a critical illness, CI insurance will provide a lumpsum, cash benefit to help you pay your out-of-pocket expenses up to the benefit level you choose. If your medical bill is less than your chosen benefit level, you can use the leftover funds in any way you like, such as to help pay for your mortgage or rent, debts, or pay for alterations to your home such as wheelchair access should you need it'],
                [2, 2, $ts, $ts, 'Those covered by a high-deductible health plan may need assistance funding the deductible in the event of a major illness. Critical illness Insurance can help pay the deductible, out-of-pocket cost or cost of specialty drugs.'],
                [2, 3, $ts, $ts, 'You might not need it if you have enough savings to fall back on and can adequately cover expenses such as bills, loans, medical costs or a mortgage or you have a partner who can cover living costs and any shared commitments such as a mortgage.   You may already have some critical illness coverage in your current health insurance policy. '],
                [2, 4, $ts, $ts, 'The Policy will pay the benefit shown in the Schedule of Benefits, if the covered Person is diagnosed for the first time by a Physician as having a Covered Condition and the diagnosis is made while the coverage is in force, if the Covered Condition is not a Pre-Existing Condition; if the Covered Person is less than age 70, if the Covered Condition is first diagnosed after 30 days from the Covered Person’s effective date, and if the Covered Person signs up for CI before the age of 65.   Please see the Critical Illness brochure for other coverage limitations and exclusions.'],
                [2, 5, $ts, $ts, 'Critical Illness insurance does not cover any extraordinary conditions such as pre-existing conditions associated with advanced stages of cancer or other diseases.  Detailed limitations of what CI covers are included in the policy’s limitations and exclusions.'],
                [2, 6, $ts, $ts, ''],

                // AME
                [3, 1, $ts, $ts, 'In case of an accident, an AME insurance policy can help you pay for out-of-pocket accident related medical expenses – such as deductibles and copays for ER visits, primary care visits, physical therapy and prescription expenses that may not be covered by your major medical insurance policy.   After the deductible is paid, benefits are payable for medical expenses incurred by you as the result of each covered accident. These benefits are paid directly to you. Convenient: Benefits are paid directly to you, not to the hospital or facility where you are being treated.   Comforting: This policy is yours, independent of your employer. You can switch jobs but keep the same AME insurance policy.'],
                [3, 2, $ts, $ts, 'Four out of ten people are treated in emergency rooms every year. The typical length of a hospital stay is five days – and costs are over $10,000. That’s more than two month’s income for the average American As major medical costs go up, consumers are increasing their deductibles and maximum out-of-pocket exposure in an effort to lower their monthly premium.  Supplemental plans such as AME are a way for consumers to lessen the impact of the increased out of pocket limits.'],
                [3, 3, $ts, $ts, 'Those with a major comprehensive medical insurance policy that has coverage for hospitalization due to accidents may not need AME insurance. But even with this type coverage, those major-medical policies make payments to the hospital. With a supplemental AME policy, the payments are made directly to you and you have discretion over use of the money.'],
                [3, 4, $ts, $ts, 'Medical Expense Policies traditionally reimburse expenses such as doctor visits while in the hospital (hospital expense) and are usually expanded to include payment for office visits, diagnostic x-rays, laboratory charges, ambulance, nursing expenses when not hospitalized.'],
                [3, 5, $ts, $ts, 'The policy provides limited accident insurance only. The accident expense policy provides limited benefit coverage for an accidental injury only. The policy does not provide coverage for legal liability. It does not provide basic hospital, basic medical or major medical insurance. This is an accident only policy and does not provide benefits for loss due to sickness or illness.'],
                [3, 6, $ts, $ts, ''],

                // AHI
                [4, 1, $ts, $ts, 'Regular health insurance pays for specific medical services after deductible or copay amounts are satisfied. By contrast, AHI insurance triggers benefit payments immediately when an accident results in hospitalization.  Accident hospital indemnity insurance (AHI) is specifically for accidents that require hospital admission, accident-related inpatient rehabilitation, and hospital stays.  It can also provide funds that can be used to help pay the out-of-pocket expenses your medical plan may not cover, such as co-insurance, co-pays, and deductibles.'],
                [4, 2, $ts, $ts, 'Accident hospital indemnity insurance would be a good supplement to those who have high deductibles for the hospitalization part of their major-medical insurance policy – or a good alternative for those who have no accident and hospital benefits from any of their insurance policies. AHI insurance provides financial help to enhance your current insurance coverage. Your health insurance plan may pay only a portion of the total expenses a hospital stay or medical treatment requires.'],
                [4, 3, $ts, $ts, 'Those who have a major-medical insurance policy with no deductible. Unfortunately, these policies are very rare because most come with a high deductible and out of pocket expense.'],
                [4, 4, $ts, $ts, 'No one plans to get injured or become hospitalized – be prepared if it happens to you. This plan provides a daily sum of benefits for hospital confinement. AHI means it pays a set amount if you’re confined in a hospital, depending on the level that you choose. The benefits are paid directly to you or your designee.'],
                [4, 5, $ts, $ts, 'Any medical expenses that aren’t a direct result of being confined in the hospital on an inpatient basis. This plan does not pay for diagnostic exams, ER visits or outpatient surgeries. However, combined with plans that do, it can provide a great level of protection from life’s mishaps.'],
                [4, 6, $ts, $ts, ''],

                // ADI
                [5, 1, $ts, $ts, 'If you become disabled from a covered accident and are unable to work, ADI insurance is designed to replace portions of your lost income.  This extremely valuable benefit pays weekly benefit checks up to $500.   These weekly benefits continue until a covered person is no longer disabled, fails to provide certificate from a physician that he/she remains disabled, reaches the end of the maximum benefit period or dies.'],
                [5, 2, $ts, $ts, 'All wage earners, that would face financial difficulty if they were left unable to work, due to an accident. Unlike Supplemental Security Income, through the Social Security Administration, which can take up to two years to receive if you are approved, private disability insurance can start after a short 30-day elimination period after a qualified disability due to an accident. Some workers may be covered by disability insurance through their employers, but many workers have limited coverage or no coverage at all.'],
                [5, 3, $ts, $ts, 'To qualify for the benefits of this plan, you must be a wage earner. ADI replaces a portion of your lost income after a 30-day elimination period. People that are retired, unemployed or don’t have documented employment would not benefit from having an ADI policy.'],
                [5, 4, $ts, $ts, 'Disability insurance, also referred to as disability income insurance or temporary disability insurance, provides a monthly tax-free benefit. This can help you cover things like food, rent, utilities, or car payments if you are unable to work due to a disability. The benefit is available for any covered accident, such as a fall, sports injury, or traffic accident, that results in the insured becoming totally disabled. The benefit is paid regardless of any other disability insurance the employee or spouse may have.'],
                [5, 5, $ts, $ts, 'Accident disability insurance is a limited benefit policy. It provides disability benefits only and does not provide basic hospital, basic medical, or major medical insurance. This coverage does not constitute comprehensive health insurance (often referred to as "major medical coverage").'],
                [5, 6, $ts, $ts, ''],

                // Dental
                [6, 1, $ts, $ts, 'With a dental insurance plan, you pay premiums, co-pays and/or deductibles, and the insurance pays the remainder directly to the dentist or through a reimbursement.  There are no network provisions, and consumers are reimbursed for a specific amount of a service rendered, regardless of who provides it. For example, when someone covered by an indemnity plan receives a dental cleaning, his or her plan pays a flat amount for the service. Any charge above that amount is the consumer’s responsibility. With an indemnity plan the insured is only responsible for the difference between what the dentist charges and the plan pays.'],
                [6, 2, $ts, $ts, 'Your health insurance covers just about everything except your teeth. Much like your car, it doesn\'t take much to spend a thousand dollars or more on dental work. A crown may cost $1,500, and a root canal might run you $300 to $1,000. Even a simple cleaning will likely come in at more than $100. Dentists aren\'t cheap and that\'s why it’s appropriate to have dental insurance.'],
                [6, 3, $ts, $ts, 'Those that have a comprehensive employer healthcare insurance policy with some dental care benefits may not need a separate individual dental insurance policy. Those with perfect teeth may not need dental insurance but even a basic cleaning of the teeth and a check for cavities can be relatively expensive, and the more major dental work can be expensive.'],
                [6, 4, $ts, $ts, 'Dental insurance plans typically have "tiers" of coverage, starting with basic options meant to cover the average expenses associated with hygiene. Your employer (or you, if you\'re going to bear the entire cost of insurance) can opt for orthodontic coverage, which includes more expensive options like braces, casts and referrals to orthodontic specialists.  There are seven basic areas of dental care that plans cover. They are as follows: Preventive Care, Restorative Care, Endodontics, Oral Surgery, Periodontics, Prosthodontics, and Orthodontics.'],
                [6, 5, $ts, $ts, 'The most costly processes, such as bridges, crowns and dentures would be classified as “major procedures”. They require a greater out-of-pocket cost as opposed to basic and preventive procedures. Usually, these procedures are covered 50 percent or less by your dental plan. Generally speaking, cosmetic dental procedures are not covered under an insurance plan, especially one managed by an employer.'],
                [6, 6, $ts, $ts, ''],

                // VSP
                [7, 1, $ts, $ts, 'Vision insurance helps offset the costs of routine eye exams and helps pay for vision correction wear, like eyeglasses, that may be prescribed by physicians or eye-care specialists. Vision insurance is generally considered supplemental insurance.  Prescription lenses are available for a copay, allowances are provided for frames and contacts, and discounts are available for sunglasses and laser vision correction. It is easy to see the benefits in these plans.'],
                [7, 2, $ts, $ts, 'Everyone that currently wears glasses or contacts, or encounters trouble reading fine print or seeing things at a distance would benefit from having vision insurance. Without vision coverage, an exam and prescription glasses can cost $300 or more. Regular eye exams are important.'],
                [7, 3, $ts, $ts, 'Those who have a comprehensive group health plan through their employer that also has some dental benefits and the lucky few who have perfect eyesight and who may think they do not need annual check-ups with eye doctors. Even the perfect eyesight folks can be beset by cataracts and other eye diseases and an annual or bi-annual visit to the eye doctor would test for these conditions.'],
                [7, 4, $ts, $ts, 'The OptimumVision program includes money-saving vision services through VSP network doctors. The VSP network doctor list includes highly skilled and professionally certified optometrists and ophthalmologists. Whether your VSP doctor is an optometrist or ophthalmologist, you’ll receive a comprehensive vision exam and you can purchase glasses and contacts in their office.'],
                [7, 5, $ts, $ts, 'The following represents what is normally excluded in vision insurance:  Any exams given during your stay in a hospital or other facility for medical care, an eye exam, or any part of an eye exam, performed for the purpose of the fitting of contact lenses, drugs or medicines, eye surgery for the correction of vision, including radial keratotomy, LASIK and similar procedures, and for prescription sunglasses or light sensitive lenses in excess of the amount which would be covered for non-tinted lenses.'],
                [7, 6, $ts, $ts, ''],
            ]);

        $this->batchInsert('product_option',
            ['product_id', 'ext_id', 'coverage_type', 'coverage_level', 'price', 'created_at', 'updated_at'],
            [
                [1, 16920, 1, '$25,000',                                            300,        $ts, $ts],
                [1, 16921, 1, '$100,000',                                           1000,       $ts, $ts],
                [1, 16922, 1, '$250,000',                                           2300,       $ts, $ts],
                [1, 16948, 3, '$25,000' ,                                           500,        $ts, $ts],
                [1, 16949, 3, '$100,000',                                           1500,       $ts, $ts],
                [1, 16950, 3, '$250,000',                                           3900,       $ts, $ts],

                [2, 16912, 1, '$5,000 CI / $5,000 ADD' ,                            1800,       $ts, $ts],
                [2, 16913, 1, '$10,000 CI / $5,000 ADD',                            3500,       $ts, $ts],
                [2, 16914, 1, '$25,000 CI / $5,000 ADD',                            8000,       $ts, $ts],
                [2, 16954, 2, '$5,000 CI / $5,000 ADD' ,                            2800,       $ts, $ts],
                [2, 16955, 2, '$10,000 CI / $5,000 ADD',                            5000,       $ts, $ts],
                [2, 16956, 2, '$25,000 CI / $5,000 ADD',                            12500,      $ts, $ts],

                [3, 16905, 1, '$2,500 AME / $5,000 ADD / $10,000 Air Ambulance',    2400,       $ts, $ts],
                [3, 16910, 1, '$5,000 AME / $5,000 ADD / $10,000 Air Ambulance',    3300,       $ts, $ts],
                [3, 16911, 1, '$7,500 AME / $5,000 ADD / $10,000 Air Ambulance',    4600,       $ts, $ts],
                [3, 16951, 3, '$2,500 AME / $5,000 ADD / $10,000 Air Ambulance',    4900,       $ts, $ts],
                [3, 16952, 3, '$5,000 AME / $5,000 ADD / $10,000 Air Ambulance',    6900,       $ts, $ts],
                [3, 16953, 3, '$7,500 AME / $5,000 ADD / $10,000 Air Ambulance',    9900,       $ts, $ts],

                [4, 16917, 1, '$500 / day',                                         800,        $ts, $ts],
                [4, 16957, 2, '$500 / day',                                         1200,       $ts, $ts],

                [5, 16918, 1, '$500 / week',                                        1800,       $ts, $ts],

                [6, 16919, 1, 'Dental Insurance',                                   3600,       $ts, $ts],
                [6, 16959, 3, 'Dental Insurance',                                   9900,       $ts, $ts],

                [7, 16895, 1, 'VSP Vision Care',                                    2200,       $ts, $ts],
                [7, 16958, 3, 'VSP Vision Care',                                    4000,       $ts, $ts],
            ]
        );

//        $this->batchInsert('product_state_map',
//            ['product_id', 'state_id', 'created_at', 'updated_at'],
//            [
//                [1, 43, $ts,    $ts],
//
//                [2, 43, $ts,    $ts],
//
//                [3, 43, $ts,    $ts],
//
//                [4, 43, $ts,    $ts],
//
//                [5, 43, $ts,    $ts],
//
//                [6, 43, $ts,    $ts],
//
//                [7, 43, $ts,    $ts],
//            ]
//        );

        $this->batchInsert('provider_state_map',
            ['provider_id', 'state_id', 'created_at', 'updated_at'],
            [
                // Catlin
                [9, 1, $ts, $ts],

                [9, 3, $ts, $ts],
                [9, 4, $ts, $ts],
                [9, 5, $ts, $ts],


                [9, 8, $ts, $ts],
                [9, 9, $ts, $ts],
                [9, 10, $ts, $ts],
                [9, 11, $ts, $ts],
                [9, 12, $ts, $ts],
                [9, 13, $ts, $ts],
                [9, 14, $ts, $ts],
                [9, 15, $ts, $ts],
                [9, 16, $ts, $ts],
                [9, 17, $ts, $ts],
                [9, 18, $ts, $ts],


                [9, 21, $ts, $ts],
                [9, 22, $ts, $ts],

                [9, 24, $ts, $ts],


                [9, 27, $ts, $ts],


                [9, 30, $ts, $ts],
                [9, 31, $ts, $ts],


                [9, 34, $ts, $ts],
                [9, 35, $ts, $ts],
                [9, 36, $ts, $ts],

                [9, 38, $ts, $ts],
                [9, 39, $ts, $ts],
                [9, 40, $ts, $ts],

                [9, 42, $ts, $ts],
                [9, 43, $ts, $ts],

                [9, 45, $ts, $ts],
                [9, 46, $ts, $ts],

                [9, 48, $ts, $ts],
                [9, 49, $ts, $ts],
                [9, 50, $ts, $ts],
                [9, 51, $ts, $ts],
                [9, 52, $ts, $ts],
                [9, 53, $ts, $ts],
                [9, 54, $ts, $ts],
                [9, 55, $ts, $ts],
                [9, 56, $ts, $ts],



                // Vision
                [10, 1, $ts, $ts],

                [10, 3, $ts, $ts],
                [10, 4, $ts, $ts],
                [10, 5, $ts, $ts],
                [10, 6, $ts, $ts],

                [10, 8, $ts, $ts],
                [10, 9, $ts, $ts],
                [10, 10, $ts, $ts],

                [10, 12, $ts, $ts],
                [10, 13, $ts, $ts],
                [10, 14, $ts, $ts],
                [10, 15, $ts, $ts],
                [10, 16, $ts, $ts],
                [10, 17, $ts, $ts],
                [10, 18, $ts, $ts],


                [10, 21, $ts, $ts],
                [10, 22, $ts, $ts],

                [10, 24, $ts, $ts],


                [10, 27, $ts, $ts],



                [10, 31, $ts, $ts],



                [10, 35, $ts, $ts],
                [10, 36, $ts, $ts],

                [10, 38, $ts, $ts],
                [10, 39, $ts, $ts],
                [10, 40, $ts, $ts],
                [10, 41, $ts, $ts],
                [10, 42, $ts, $ts],
                [10, 43, $ts, $ts],


                [10, 46, $ts, $ts],

                [10, 48, $ts, $ts],
                [10, 49, $ts, $ts],

                [10, 51, $ts, $ts],
                [10, 52, $ts, $ts],
                [10, 53, $ts, $ts],
                [10, 54, $ts, $ts],
                [10, 55, $ts, $ts],
                [10, 56, $ts, $ts],

                //RLSI
                [11, 1, $ts, $ts],
                [11, 2, $ts, $ts],
                [11, 3, $ts, $ts],
                [11, 4, $ts, $ts],
                [11, 5, $ts, $ts],
                [11, 6, $ts, $ts],
                [11, 7, $ts, $ts],
                [11, 8, $ts, $ts],
                [11, 9, $ts, $ts],
                [11, 10, $ts, $ts],
                [11, 11, $ts, $ts],

                [11, 13, $ts, $ts],
                [11, 14, $ts, $ts],
                [11, 15, $ts, $ts],
                [11, 16, $ts, $ts],
                [11, 17, $ts, $ts],


                [11, 20, $ts, $ts],
                [11, 21, $ts, $ts],
                [11, 22, $ts, $ts],
                [11, 23, $ts, $ts],
                [11, 24, $ts, $ts],
                [11, 25, $ts, $ts],
                [11, 26, $ts, $ts],
                [11, 27, $ts, $ts],
                [11, 28, $ts, $ts],
                [11, 29, $ts, $ts],
                [11, 30, $ts, $ts],
                [11, 31, $ts, $ts],

                [11, 33, $ts, $ts],
                [11, 34, $ts, $ts],
                [11, 35, $ts, $ts],
                [11, 36, $ts, $ts],

                [11, 38, $ts, $ts],
                [11, 39, $ts, $ts],
                [11, 40, $ts, $ts],
                [11, 41, $ts, $ts],
                [11, 42, $ts, $ts],
                [11, 43, $ts, $ts],
                [11, 44, $ts, $ts],
                [11, 45, $ts, $ts],
                [11, 46, $ts, $ts],

                [11, 48, $ts, $ts],
                [11, 49, $ts, $ts],
                [11, 50, $ts, $ts],
                [11, 51, $ts, $ts],
                [11, 52, $ts, $ts],
                [11, 53, $ts, $ts],
                [11, 54, $ts, $ts],
                [11, 55, $ts, $ts],
                [11, 56, $ts, $ts],
            ]
        );



        $this->batchInsert('state',
            ['name', 'two_letter', 'created_at', 'updated_at'],
            [
                ['Alabama',                     'AL', $ts, $ts],
                ['Alaska',                      'AK', $ts, $ts],
                ['Arizona',                     'AZ', $ts, $ts],
                ['Arkansas',                    'AR', $ts, $ts],
                ['California',                  'CA', $ts, $ts],
                ['Colorado',                    'CO', $ts, $ts],
                ['Connecticut',                 'CT', $ts, $ts],
                ['Delaware',                    'DE', $ts, $ts],
                ['Florida',                     'FL', $ts, $ts],
                ['Georgia',                     'GA', $ts, $ts],
                ['Hawaii',                      'HI', $ts, $ts],
                ['Idaho',                       'ID', $ts, $ts],
                ['Illinois',                    'IL', $ts, $ts],
                ['Indiana',                     'IN', $ts, $ts],
                ['Iowa',                        'IA', $ts, $ts],
                ['Kansas',                      'KS', $ts, $ts],
                ['Kentucky',                    'KY', $ts, $ts],
                ['Louisiana',                   'LA', $ts, $ts],
                ['Maine',                       'ME', $ts, $ts],
                ['Maryland',                    'MD', $ts, $ts],
                ['Massachusetts',               'MA', $ts, $ts],
                ['Michigan',                    'MI', $ts, $ts],
                ['Minnesota',                   'MN', $ts, $ts],
                ['Mississippi',                 'MS', $ts, $ts],
                ['Missouri',                    'MO', $ts, $ts],
                ['Montana',                     'MT', $ts, $ts],
                ['Nebraska',                    'NE', $ts, $ts],
                ['Nevada',                      'NV', $ts, $ts],
                ['New Hampshire',               'NH', $ts, $ts],
                ['New Jersey',                  'NJ', $ts, $ts],
                ['New Mexico',                  'NM', $ts, $ts],
                ['New York',                    'NY', $ts, $ts],
                ['North Carolina',              'NC', $ts, $ts],
                ['North Dakota',                'ND', $ts, $ts],
                ['Ohio',                        'OH', $ts, $ts],
                ['Oklahoma',                    'OK', $ts, $ts],
                ['Oregon',                      'OR', $ts, $ts],
                ['Pennsylvania',                'PA', $ts, $ts],
                ['Rhode Island',                'RI', $ts, $ts],
                ['South Carolina',              'SC', $ts, $ts],
                ['South Dakota',                'SD', $ts, $ts],
                ['Tennessee',                   'TN', $ts, $ts],
                ['Texas',                       'TX', $ts, $ts],
                ['Utah',                        'UT', $ts, $ts],
                ['Vermont',                     'VT', $ts, $ts],
                ['Virginia',                    'VA', $ts, $ts],
                ['Washington',                  'WA', $ts, $ts],
                ['West Virginia',               'WV', $ts, $ts],
                ['Wisconsin',                   'WI', $ts, $ts],
                ['Wyoming',                     'WY', $ts, $ts],
                ['District of Columbia',        'DC', $ts, $ts],
                ['American Samoa',              'AS', $ts, $ts],
                ['Guam',                        'GU', $ts, $ts],
                ['Northern Mariana Islands',    'MP', $ts, $ts],
                ['Puerto Rico',                 'PR', $ts, $ts],
                ['U.S. Virgin Islands',         'VI', $ts, $ts],
            ]
        );


    }
}