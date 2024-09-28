
export const navLinks = [
    {
        parentText: 'Personal',
        children: [
            {
                childText: 'Plan Details',
                childLink: route('personal-plan.plan-detail'),
                isContent: false,
                component: 'personal-plan-details',
                data: {
                    title: 'Personal Plan Details'
                }
            },
            {
                childText: 'Coverage and Pricing',
                childLink: route('personal-plan.converage-and-pricing'),
                isContent: false,
                component: 'personal-coverage&pricing',
                data: {
                    title: 'Personal Plan Coverage and Pricing'
                }
                // children: [
                //     {
                //         childText: 'K1 (Fiancee) Visa',
                //         childLink: route('landlords.negotiating-leases')
                //     },
                //     {
                //         childText: 'K2 (dependent)  Visa',
                //         childLink: route('landlords.negotiating-leases')
                //     },
                //     {
                //         childText: 'US Tourist Visa',
                //         childLink: route('landlords.negotiating-leases')
                //     },
                //     {
                //         childText: 'E-2 Investment Visa',
                //         childLink: route('landlords.negotiating-leases')
                //     },
                //     {
                //         childText: 'EB-5 Visa investment',
                //         childLink: route('landlords.negotiating-leases')
                //     },
                //     {
                //         childText: 'L-1 Intracompany Visa',
                //         childLink: route('landlords.negotiating-leases')
                //     },
                //     {
                //         childText: 'CR-1 Visa Marriage Visa',
                //         childLink: route('landlords.negotiating-leases')
                //     },
                //     {
                //         childText: 'IR-1 Visa Marriage',
                //         childLink: route('landlords.negotiating-leases')
                //     },
                //     {
                //         childText: 'I-601 Waiver Application',
                //         childLink: route('landlords.negotiating-leases')
                //     },

                // ],
            },
            {
                childText: 'Why Thai Legal Protection for Personal?',
                childLink: window.route('personal-plan.why-choose'),
                isContent: false,
                component: 'personal-whyTLP',
                data: {
                    title: 'Why Thai Legal Protection for Personal?'
                }
            },
            {
                childText: 'FAQs',
                childLink: window.route('personal-plan.faq'),
                isContent: false,
                component: 'personal-FAQ',
                data: {
                    title: 'Personal Plan FAQs'
                }
            },



            {
                childText: 'Visa and Immigration Issues',
                // childLink: '#',
                children: [
                    {
                        childText: 'Thai Visas',
                        childLink: route('personal.visa-and-immigration-issues.thai-visas'),
                    },
                    {
                        childText: 'International Visas',
                        childLink: route('personal.visa-and-immigration-issues.international-visas'),
                    },
                    {
                        childText: 'Overstay Issues',
                        childLink: route('personal.visa-and-immigration-issues.overstay-issues'),
                    },
                ]
            },


            {
                childText: 'Estate Planning and Wills',
                // childLink: '#',
                children: [
                    {
                        childText: 'Living Will',
                        childLink: route('personal.estate-planning-and-wills.living-will'),
                    },
                    {
                        childText: 'Last Will & Testament',
                        childLink: route('personal.estate-planning-and-wills.last-will-and-testament'),
                    },
                    {
                        childText: 'Probate',
                        childLink: route('personal.estate-planning-and-wills.probate')
                    },
                    {
                        childText: 'Power of Attorney',
                        childLink: route('personal.estate-planning-and-wills.power-of-attorney'),
                    },
                ]
            },



            {
                childText: 'Rental and Property Disputes',
                // childLink: '#',
                children: [
                    {
                        childText: 'Renter',
                        childLink: route('personal.rental-and-property-disputes.renter'),
                    },
                    {
                        childText: 'Landlord',
                        childLink: route('personal.rental-and-property-disputes.landlord'),
                    },
                ]
            },



            {
                childText: 'Property Rights for Expats',
                // childLink: '#',
                children: [
                    {
                        childText: 'Freehold',
                        childLink: '#',
                    },
                    {
                        childText: 'Leasehold',
                        childLink: '#',
                    },
                    {
                        childText: 'Superficies Rights',
                        childLink: '#',
                    },
                    {
                        childText: 'Usufruct Rights',
                        childLink: '#',
                    },
                ]
            },



            {
                childText: 'Expat Support Services',
                // childLink: '#',
                children: [
                    {
                        childText: 'Healthcare and Insurance',
                        childLink: route('personal.expat-support-services.health-care-and-insurance'),
                    },
                    {
                        childText: 'Insurance Claims',
                        childLink: route('personal.expat-support-services.insurance-claims'),
                    },
                    {
                        childText: 'Driving and Transportation',
                        childLink: route('personal.expat-support-services.driving-and-transportation'),
                    },
                    // {
                    //     childText: 'Banking And Financial Matters',
                    //     childLink: route('personal.expat-support-services.banking-and-financial-matters'),
                    // },
                    {
                        childText: 'Cultural and Legal Adjustments',
                        childLink: route('personal.expat-support-services.cultural-and-legal-adjustments'),
                    },
                    {
                        childText: 'Open A Bank Account',
                        childLink: '#',
                    },
                ]
            },








            {
                childText: 'Document Review & Advice',
                // childLink: '#',
                children: [
                    {
                        childText: 'Contract Review',
                        childLink: '',
                    },
                    {
                        childText: 'Second Opinions',
                        childLink: '',
                    },
                    {
                        childText: 'Contractual Issues',
                        childLink: '',
                    },
                ]
            },

            {
                childText: 'Legal Issues',
                // childLink: '#',
                children: [
                    {
                        childText: 'Employment',
                        childLink: '',
                    },
                    {
                        childText: 'Debt Collection',
                        childLink: '',
                    },
                    {
                        childText: 'Family Law',
                        childLink: '',
                    },
                    {
                        childText: 'Criminal Law',
                        childLink: '',
                    },
                    {
                        childText: 'Traffic Accident',
                        childLink: '',
                    },
                ]
            },




        ],
    },

    {
        parentText: 'Business',
        children: [
            {
                childText: 'Plan Details',
                childLink: route('business-plan.personal-detail'),
                isContent: false,
                component: 'business-plan-details',
                data: {
                    title: 'Business Plan Details'
                }
            },
            {
                childText: 'Coverage and Pricing',
                childLink : route('business-plan.converage-and-pricing'),
                isContent: false,
                component: 'business-coverage&pricing',
                data: {
                    title: 'Business Plan coverage and pricing'
                }
            },
            {
                childText: 'Why Thai Legal Protection for Business?',
                childLink: route('business-plan.why-choose'),
                isContent: false,
                component: 'business-whyTLP',
                data: {
                    title: 'Why Thai Legal Protection for Business?'
                }
            },
            {
                childText: 'FAQs',
                childLink: window.route('business-plan.faq'),
                isContent: false,
                component: 'business-FAQ',
                data: {
                    title: 'Business Plan FAQs'
                }
            },



            {
                childText: 'Company Registration',
                childLink: route('business.company-registration'),
            },
            {
                childText: 'Visa & Work Permit',
                childLink: route('business.visa-and-work-permit'),
            },

            {
                childText: 'Debt Collection',
                // childLink: '#',
                children: [
                    {
                        childText: 'Debt Settlement',
                        childLink: route('business.debt-collection.debt-settlement-assistance'),
                    },
                    {
                        childText: 'Debt Collection Letter',
                        childLink: route('business.debt-collection.debt-collection-letter-assistance'),
                    },
                    {
                        childText: 'Debt Negotiation',
                        childLink: route('business.debt-collection.debt-negotiation-assistance'),
                    },
                ]
            },


            {
                childText: 'Labor Laws',
                childLink: route('business.labor-law'),
            },

            {
                childText: 'Licenses and Permits',
                childLink: route('business.licenses-and-permits'),
            },

            {
                childText: 'Civil Litigation',
                childLink: route('business.civil-litigation-matters'),
            },

            {
                childText: 'Taxation and Accounting',
                childLink: route('business.taxation-and-accounting'),
            },

            // {
            //     childText: 'Opening A Thai Bank Account',
            //     childLink: route('business.opening-a-thai-bank-account'),
            // },

            // {
            //     childText: 'Banking & Financial Services',
            //     childLink: '#',
            // },

            {
                childText: 'Intellectual Property Protection',
                // childLink: '',
                children: [
                    {
                        childText: 'Copyright',
                        childLink: route('business.intellectual-property-protection.copyright-protection')
                    },

                    {
                        childText: 'Trade Marks',
                        childLink: route('business.intellectual-property-protection.trademark-protection')
                    },

                ]
            },

            {
                childText: 'Dispute Resolution',
                // childLink: '',
                children: [
                    {
                        childText: 'Mediation Services',
                        childLink: route('business.dispute-resolution.mediation-services')
                    },

                    {
                        childText: 'Arbitration Services',
                        childLink: '#'
                    },

                    {
                        childText: 'Litigation Support',
                        childLink: '#'
                    },

                ]
            },
        ],
    },

    {
        parentText: 'About Us',
        children: [
            {
                childText: 'About Us',
                childLink: route('about-us'),
                // isContent: true,
                // component: 'about-us',
                // data: {
                //     title: 'About Us'
                // }
            },
            {
                childText: 'FAQs',
                childLink: route('faqs-general'),
                // childLink: '#',
                // isContent: true,
                // component: 'faq',
                // data: {
                //     title: 'FAQs(General)'
                // }
            },
        ],
    },

    // {
    //     parentText: 'Legal',
    //     children: [
    //         {
    //             childText: 'Legal and Translation Services',
    //             childLink: '#',
    //             children: [
    //                 {
    //                     childText: 'Private Investigation',
    //                     childLink: route('landlords.negotiating-leases')
    //                 },
    //                 {
    //                     childText: 'Translation & Legalization',
    //                     childLink: route('landlords.negotiating-leases')
    //                 },
    //                 {
    //                     childText: 'Power of Attorney',
    //                     childLink: route('landlords.negotiating-leases')
    //                 },
    //                 {
    //                     childText: 'Notary Service',
    //                     childLink: route('landlords.negotiating-leases')
    //                 },
    //                 {
    //                     childText: 'Litigation Services',
    //                     childLink: route('landlords.negotiating-leases')
    //                 },
    //             ],
    //         },
    //         {
    //             childText: 'Blog',
    //             childLink: window.route('resources.blog'),
    //         },
    //     ],
    // },

    // {
    //     parentText: 'Real Estate',
    //     children: [
    //         {
    //             childText: 'Buying Property',
    //             childLink: '#',
    //             children: [
    //                 {
    //                     childText: 'Thailand Condo',
    //                     childLink: route('landlords.negotiating-leases')
    //                 },
    //                 {
    //                     childText: 'Condo Resale',
    //                     childLink: route('landlords.negotiating-leases')
    //                 },
    //                 {
    //                     childText: 'Leases',
    //                     childLink: route('landlords.negotiating-leases')
    //                 },
    //                 {
    //                     childText: 'Mortgages',
    //                     childLink: route('landlords.negotiating-leases')
    //                 },
    //             ],
    //         },
    //         {
    //             childText: 'Property Services',
    //             childLink: '#',
    //             children: [
    //                 {
    //                     childText: 'Due Diligence',
    //                     childLink: route('landlords.negotiating-leases')
    //                 },
    //                 {
    //                     childText: 'Contract Review',
    //                     childLink: route('landlords.negotiating-leases')
    //                 },
    //                 {
    //                     childText: 'Transfer of Title',
    //                     childLink: route('landlords.negotiating-leases')
    //                 },
    //                 {
    //                     childText: 'Property Taxes',
    //                     childLink: route('landlords.negotiating-leases')
    //                 },
    //             ],
    //         },
    //         {
    //             childText: 'Escrow Accounts',
    //             childLink: '#',
    //             children: [
    //                 {
    //                     childText: 'Transfer Money to Thailand',
    //                     childLink: route('landlords.negotiating-leases')
    //                 },
    //             ],
    //         },
    //     ],
    // },

    // {
    //     parentText: 'Plans',
    //     children: [
    //         {
    //             childText: 'Personal & Family',
    //             childLink: '#',
    //             children: [
    //                 {
    //                     childText: 'Coverage & Pricing',
    //                     childLink: window.route(
    //                         'personal-plan.converage-and-pricing'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'FAQ',
    //                     childLink:
    //                         window.route('personal-plan.faq'),
    //                 },
    //                 {
    //                     childText: 'How it works',
    //                     childLink: window.route(
    //                         'personal-plan.how-it-works'
    //                     ),
    //                 },
    //             ],
    //         },
    //         {
    //             childText: 'Run a Business',
    //             childLink: '#',
    //             children: [
    //                 {
    //                     childText: 'Coverage & Pricing',
    //                     childLink: window.route(
    //                         'business-plan.converage-and-pricing'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'FAQ',
    //                     childLink:
    //                         window.route('business-plan.faq'),
    //                 },
    //                 {
    //                     childText: 'How it works',
    //                     childLink: window.route(
    //                         'business-plan.how-it-works'
    //                     ),
    //                 },
    //             ],
    //         },
    //     ],
    // },
    // {
    //     parentText: 'Personals',
    //     children: [
    //         {
    //             childText: 'Estate Planning',
    //             childLink: '#',
    //             children: [
    //                 {
    //                     childText: 'Estate Planning Matters',
    //                     childLink: window.route(
    //                         'estate-planning.index'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Last Will And Testament',
    //                     childLink: window.route(
    //                         'estate-planning.last-will-and-testament'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Living Wills',
    //                     childLink: window.route(
    //                         'estate-planning.living-will'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Power of Attorney',
    //                     childLink: window.route(
    //                         'estate-planning.power-of-attorney'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Trusts',
    //                     childLink: window.route(
    //                         'estate-planning.trusts'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Probate',
    //                     childLink: window.route(
    //                         'estate-planning.probate'
    //                     ),
    //                 },
    //             ],
    //         },
    //         {
    //             childText: 'Consumer Finance',
    //             childLink: '#',
    //             children: [
    //                 {
    //                     childText: 'Consumer Finance Matters',
    //                     childLink: window.route(
    //                         'consumer-finance.index'
    //                     ),
    //                 },
    //             ],
    //         },
    //         {
    //             childText: 'Real Estate',
    //             childLink: '#',
    //             children: [
    //                 {
    //                     childText: 'Real Estate Matters',
    //                     childLink:
    //                         window.route('real-estate.index'),
    //                 },
    //             ],
    //         },
    //         {
    //             childText: 'Renters',
    //             childLink: '#',
    //             children: [
    //                 {
    //                     childText: 'Renter Matters',
    //                     childLink: window.route('renters.index'),
    //                 },
    //                 {
    //                     childText: 'Signing a lease',
    //                     childLink: window.route(
    //                         'renters.signing-a-lease'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Evictions',
    //                     childLink: window.route(
    //                         'renters.eviction-notice'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Security Deposits',
    //                     childLink: window.route(
    //                         'renters.security-deposit'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Terminating a lease',
    //                     childLink: window.route(
    //                         'renters.lease-termination'
    //                     ),
    //                 },
    //             ],
    //         },
    //         {
    //             childText: 'LandLords',
    //             childLink: '#',
    //             children: [
    //                 {
    //                     childText: 'LandLord Matters',
    //                     childLink: window.route('landlords.index'),
    //                 },
    //                 {
    //                     childText: 'Negotiating Leases',
    //                     childLink: window.route(
    //                         'landlords.negotiating-leases'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Terminating Leases',
    //                     childLink: window.route(
    //                         'landlords.terminating-leases'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Tenant Without a lease',
    //                     childLink: window.route(
    //                         'landlords.tenant-without-a-lease'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'How To Evict A Tenant',
    //                     childLink: window.route(
    //                         'landlords.how-to-evict-a-tenant'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Eviction Defenses',
    //                     childLink: window.route(
    //                         'landlords.eviction-defenses'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Problem Tenants',
    //                     childLink: window.route(
    //                         'landlords.problem-tenant'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Security Deposits',
    //                     childLink: window.route(
    //                         'landlords.security-deposits'
    //                     ),
    //                 },
    //             ],
    //         },
    //         {
    //             childText: 'Family Law',
    //             childLink: '#',
    //             children: [
    //                 {
    //                     childText: 'Family Law Matters',
    //                     childLink: window.route('family-law.index'),
    //                 },
    //                 {
    //                     childText: 'Divorce',
    //                     childLink:
    //                         window.route('family-law.divorce'),
    //                 },
    //                 {
    //                     childText: 'Prenuptial Agreement',
    //                     childLink: window.route(
    //                         'family-law.prenuptial-agreement'
    //                     ),
    //                 },
    //                 {
    //                     childText:
    //                         'Child Guardianship Custody & Visitation',
    //                     childLink: window.route(
    //                         'family-law.child-custody'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Name Changes',
    //                     childLink: window.route(
    //                         'family-law.name-change'
    //                     ),
    //                 },
    //             ],
    //         },
    //         {
    //             childText: 'Employee Rights',
    //             childLink: '#',
    //             children: [
    //                 {
    //                     childText: 'Employee Right Matters',
    //                     childLink:
    //                         window.route('employee-law.index'),
    //                 },
    //             ],
    //         },
    //         {
    //             childText: 'Traffic & Accidents',
    //             childLink: '#',
    //             children: [
    //                 {
    //                     childText: 'Traffic & Accident Matters',
    //                     childLink: window.route(
    //                         'traffic-accident.index'
    //                     ),
    //                 },
    //             ],
    //         },
    //         {
    //             childText: 'Add on Coverage',
    //             childLink: '#',
    //             children: [
    //                 {
    //                     childText: 'Trial Defense Supplement',
    //                     childLink: window.route(
    //                         'add-on-coverage.index'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Gun owner Supplement',
    //                     childLink: window.route(
    //                         'add-on-coverage.gun-supplement'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Home Business Supplement',
    //                     childLink: window.route(
    //                         'add-on-coverage.legal-protection-home-business'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'RideShare Supplement',
    //                     childLink: window.route(
    //                         'add-on-coverage.legal-ride-and-delivery-driver'
    //                     ),
    //                 },
    //             ],
    //         },
    //     ],
    // },
    // {
    //     parentText: 'Business',
    //     children: [
    //         {
    //             childText: 'Debt Collection',
    //             childLink: '#',
    //             children: [
    //                 {
    //                     childText:
    //                         'Bankruptcy & Debt Collection Matters',
    //                     childLink: window.route('collection.index'),
    //                 },
    //                 {
    //                     childText: 'Small Claim Court',
    //                     childLink: window.route(
    //                         'collection.small-claim-court'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Dept Collection Letter',
    //                     childLink: window.route(
    //                         'collection.collection-letter'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Dept Collection Lawyer',
    //                     childLink: window.route(
    //                         'collection.collection-attorney'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Debt Negotiation',
    //                     childLink: window.route(
    //                         'collection.negotiation'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Debt Settlement',
    //                     childLink: window.route(
    //                         'collection.settlement'
    //                     ),
    //                 },
    //             ],
    //         },
    //         {
    //             childText: 'Business Licenses',
    //             childLink: '#',
    //             children: [
    //                 {
    //                     childText: 'Business License Matters',
    //                     childLink: window.route(
    //                         'business-licenses.index'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Business Permits',
    //                     childLink: window.route(
    //                         'business-licenses.business-permits'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Fedral And State Requirments',
    //                     childLink: window.route(
    //                         'business-licenses.fedral-and-state-requirments'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'DBA',
    //                     childLink: window.route(
    //                         'business-licenses.dba'
    //                     ),
    //                 },
    //             ],
    //         },
    //         {
    //             childText: 'Civil Litigation',
    //             childLink: '#',
    //             children: [
    //                 {
    //                     childText: 'Civil Litigation Matters',
    //                     childLink: window.route(
    //                         'civil-litigation.index'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Labor LawSuit',
    //                     childLink: window.route(
    //                         'civil-litigation.labor-lawsuit'
    //                     ),
    //                 },
    //                 {
    //                     childText:
    //                         'Intellectual Property Infringement',
    //                     childLink: window.route(
    //                         'civil-litigation.intellectual-property-infringement'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Employment Litigation',
    //                     childLink: window.route(
    //                         'civil-litigation.employee-litigation'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Beach Of Contract',
    //                     childLink: window.route(
    //                         'civil-litigation.beach-of-contract'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Bankruptch Dissolution',
    //                     childLink: window.route(
    //                         'civil-litigation.bankruptcy-dissolution'
    //                     ),
    //                 },
    //             ],
    //         },
    //         {
    //             childText: 'Contracts And Agreements',
    //             childLink: '#',
    //             children: [
    //                 {
    //                     childText: 'Contract & Agreement Matters',
    //                     childLink: window.route('contract.index'),
    //                 },
    //                 {
    //                     childText: 'Demand For Payment',
    //                     childLink: window.route(
    //                         'contract.demand-for-payment'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Lease Agreements',
    //                     childLink: window.route(
    //                         'contract.lease-agreements'
    //                     ),
    //                 },
    //                 {
    //                     childText:
    //                         'Independent Contractor Agreement',
    //                     childLink: window.route(
    //                         'contract.independent-contractor-agreement'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'Eviction Notices',
    //                     childLink: window.route(
    //                         'contract.eviction-notices'
    //                     ),
    //                 },
    //             ],
    //         },
    //         {
    //             childText: 'Employers',
    //             childLink: '#',
    //             children: [
    //                 {
    //                     childText: 'Employer Matters',
    //                     childLink: window.route('employment.index'),
    //                 },
    //                 {
    //                     childText: 'Hiring And Firing',
    //                     childLink: window.route(
    //                         'employment.hiring-and-firing'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'ADA',
    //                     childLink: window.route('employment.ada'),
    //                 },
    //                 {
    //                     childText: 'Worker\'s Comp',
    //                     childLink: window.route(
    //                         'employment.workers-comp'
    //                     ),
    //                 },
    //             ],
    //         },
    //         {
    //             childText: 'Intellecutal Property',
    //             childLink: '#',
    //             children: [
    //                 {
    //                     childText: 'Intellecutal Property',
    //                     childLink: window.route(
    //                         'intellectual-property.index'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'CopyRight',
    //                     childLink: window.route(
    //                         'intellectual-property.copyright'
    //                     ),
    //                 },
    //                 {
    //                     childText: 'TradeMarks',
    //                     childLink: window.route(
    //                         'intellectual-property.trademarks'
    //                     ),
    //                 },
    //             ],
    //         },
    //     ],
    // },
    // {
    //     parentText: 'Resources',
    //     children: [
    //         {
    //             childText: 'How it works',
    //             childLink: window.route('resources.how-it-works'),
    //             children:[]
    //         },
    //         {
    //             childText: 'Blog',
    //             childLink: window.route('resources.blog'),
    //             children:[]
    //         },
    //         {
    //             childText: 'Lawyer Directory',
    //             childLink: window.route('resources.law-directory'),
    //             children:[]
    //         },
    //         {
    //             childText: 'FAQ',
    //             childLink: window.route('resources.faq'),
    //             children:[]
    //         },
    //         {
    //             childText: 'About us',
    //             childLink: window.route('resources.about-us'),
    //             children:[]
    //         },
    //         {
    //             childText: 'Contact us',
    //             childLink: window.route('resources.contact-us'),
    //             children:[]
    //         },
    //     ],
    // },
    // {
    //     parentText: 'Pricing',
    //     childLink: '#',
    //     children: []
    // },
];
