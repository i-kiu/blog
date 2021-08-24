<?php

/*
 * This file is part of the package t3g/blog.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$ll = 'LLL:EXT:blog/Resources/Private/Language/locallang_db.xlf' . ':';

return [
    'ctrl' => [
        'title' => $ll . 'tx_blog_domain_model_author',
        'label' => 'name',
        'label_alt_force' => 0,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'default_sortby' => 'ORDER BY title',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'typeicon_classes' => [
            'default' => 'record-blog-author'
        ],
        'searchFields' => 'uid,name,title',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource',
    ],
    'interface' => [
        'showRecordFieldList' => '
            hidden,
            name,
            slug,
            image,
            title,
            website,
            email,
            location,
            twitter,
            linkedin,
            xing,
            profile,
            bio,
            posts
        ',
    ],
    'palettes' => [
        'palette_access' => [
            'showitem' => 'hidden'
        ],
        'palette_personal' => [
            'showitem' => 'name, title'
        ],
        'palette_contact' => [
            'showitem' => 'website, email'
        ],
    ],
    'columns' => [
        'pid' => [
            'label' => 'pid',
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'crdate' => [
            'label' => 'crdate',
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'tstamp' => [
            'label' => 'tstamp',
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'name' => [
            'label' => $ll . 'tx_blog_domain_model_author.name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'required',
            ],
            'l10n_display' => 'defaultAsReadonly',
            'l10n_mode' => 'exclude',
        ],
        'slug' => [
            'label' => $ll . 'tx_blog_domain_model_author.slug',
            'config' => [
                'type' => 'slug',
                'generatorOptions' => [
                    'fields' => ['name'],
                    'replacements' => [
                        '/' => ''
                    ],
                ],
                'fallbackCharacter' => '-',
                'eval' => 'uniqueInSite',
                'default' => ''
            ],
            'l10n_display' => 'defaultAsReadonly',
            'l10n_mode' => 'exclude',
        ],
        'avatar_provider' => [
            'label' => $ll . 'tx_blog_domain_model_author.avatar_provider',
            'onChange' => 'reload',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Please choose one avatar provider', '--div--'],
                    ['Gravatar', \T3G\AgencyPack\Blog\AvatarProvider\GravatarProvider::class],
                    ['Image', \T3G\AgencyPack\Blog\AvatarProvider\ImageProvider::class],
                ],
            ],
            'l10n_mode' => 'exclude',
        ],
        'image' => [
            'label' => $ll . 'tx_blog_domain_model_author.image',
            'displayCond' => 'FIELD:avatar_provider:=:T3G\AgencyPack\Blog\AvatarProvider\ImageProvider',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'image',
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
                    ],
                    // custom configuration for displaying fields in the overlay/reference table
                    // to use the newsPalette and imageoverlayPalette instead of the basicoverlayPalette
                    'overrideChildTca' => [
                        'types' => [
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_UNKNOWN => [
                                'showitem' => '
                                                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;newsPalette,
                                                        --palette--;;imageoverlayPalette,
                                                        --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
                                'showitem' => '
                                                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;newsPalette,
                                                        --palette--;;imageoverlayPalette,
                                                        --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                'showitem' => '
                                                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;newsPalette,
                                                        --palette--;;imageoverlayPalette,
                                                        --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
                                'showitem' => '
                                                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;newsPalette,
                                                        --palette--;;audioOverlayPalette,
                                                        --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                                'showitem' => '
                                                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;newsPalette,
                                                        --palette--;;videoOverlayPalette,
                                                        --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
                                'showitem' => '
                                                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;newsPalette,
                                                        --palette--;;imageoverlayPalette,
                                                        --palette--;;filePalette'
                            ]
                        ],
                    ],
                    'minitems' => 0,
                    'maxitems' => 1,
                ],
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
            'l10n_mode' => 'exclude',
        ],
        'title' => [
            'label' => $ll . 'tx_blog_domain_model_author.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => '',
            ],
        ],
        'website' => [
            'label' => $ll . 'tx_blog_domain_model_author.website',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'domainname',
            ],
            'l10n_mode' => 'exclude',
        ],
        'email' => [
            'label' => $ll . 'tx_blog_domain_model_author.email',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'required,email',
            ],
            'l10n_mode' => 'exclude',
        ],
        'location' => [
            'label' => $ll . 'tx_blog_domain_model_author.location',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => '',
            ],
            'l10n_mode' => 'exclude',
        ],
        'twitter' => [
            'label' => $ll . 'tx_blog_domain_model_author.twitter',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => '',
            ],
            'l10n_mode' => 'exclude',
        ],
        'linkedin' => [
            'label' => $ll . 'tx_blog_domain_model_author.linkedin',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => '',
            ],
            'l10n_mode' => 'exclude',
        ],
        'xing' => [
            'label' => $ll . 'tx_blog_domain_model_author.xing',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => '',
            ],
            'l10n_mode' => 'exclude',
        ],
        'profile' => [
            'label' => $ll . 'tx_blog_domain_model_author.profile',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => '',
            ],
            'l10n_mode' => 'exclude',
        ],
        'bio' => [
            'label' => $ll . 'tx_blog_domain_model_author.bio',
            'config' => [
                'type' => 'text',
                'eval' => '',
            ],
        ],
        'posts' => [
            'label' => $ll . 'tx_blog_domain_model_author.posts',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'multiple' => 0,
                'foreign_table' => 'pages',
                'foreign_table_where' => 'AND {#pages}.{#doktype}=' . \T3G\AgencyPack\Blog\Constants::DOKTYPE_BLOG_POST . ' AND {#pages}.{#sys_language_uid} IN (-1,0)',
                'MM' => 'tx_blog_post_author_mm',
                'MM_opposite_field' => 'authors',
                'minitems' => 0,
                'maxitems' => 99999,
            ],
            'l10n_mode' => 'exclude',
        ],
        'details_page' => [
            'label' => $ll . 'tx_blog_domain_model_author.details_page',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'pages',
                'size' => 1,
                'maxitems' => 1,
                'minitems' => 0,
                'default' => 0
            ],
            'l10n_mode' => 'exclude',
        ]
    ],
    'sys_language_uid' => [
        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
        'config' => [
            'type' => 'select',
            'default' => 0,
            'renderType' => 'selectSingle',
            'foreign_table' => 'sys_language',
            'foreign_table_where' => 'ORDER BY sys_language.title',
            'items' => [
                ['LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages', -1],
                ['LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.default_value', 0],
            ],
        ],
    ],
    'l18n_parent' => [
        'displayCond' => 'FIELD:sys_language_uid:>:0',
        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['', 0],
            ],
            'foreign_table' => 'tx_blog_domain_model_author',
            'foreign_table_where' => 'AND tx_blog_domain_model_author.pid=###CURRENT_PID### AND tx_blog_domain_model_author.sys_language_uid IN (-1,0)',
        ],
    ],
    'l18n_diffsource' => [
        'config' => [
            'type' => 'passthrough',
        ],
    ],
    'types' => [
        0 => [
            'showitem' => '
                --div--;' . $ll . 'tx_blog_domain_model_author.tab_profile,
                    --palette--;' . $ll . 'tx_blog_domain_model_author.palette_personal;palette_personal,
                    slug,
                    location,
                    avatar_provider,
                    image,
                    bio,
                    --palette--;' . $ll . 'tx_blog_domain_model_author.palette_contact;palette_contact,
                --div--;' . $ll . 'tx_blog_domain_model_author.tab_social_media,
                    twitter,
                    linkedin,
                    xing,
                    profile,
                --div--;' . $ll . 'tx_blog_domain_model_author.tab_blog,
                    posts,
                    details_page,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                    --palette--;;palette_access
            ',
        ],
    ],
];
