<?php

namespace Bioversity\ServerConnectionBundle\Repository;

use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\Operators;
use Bioversity\ServerConnectionBundle\Repository\ServerQueryManager;
use Bioversity\ServerConnectionBundle\Repository\ServerRequestManager;

class Tags
{
	/*=======================================================================================
	 *	IDENTIFICATION ATTRIBUTES															*
	 *======================================================================================*/

	/**
	 * _id.
	 *
	 * Native identifier.
	 *
	 * This attribute contains the native unique identifier of the object. This identifier is
	 * used as the default unique key for all objects and can have any scalar data type.
	 */
	const kTAG_NID =   								'_id';

	/**
	 * NAMESPACE.
	 *
	 * Namespace.
	 *
	 * This attribute is a reference to a term which represents the namespace of the current
	 * object. The object local identifiers must be unique within the scope of the namespace.
	 */
	const kTAG_NAMESPACE =   						'1';

	/**
	 * LID.
	 *
	 * Local identifier.
	 *
	 * This attribute contains the local unique identifier. This value represents the value that
	 * uniquely identifies an object within a specific domain or namespace. It is by definition
	 * a string constituting the suffix of the global identifier, {@link kTAG_GID}.
	 */
	const kTAG_LID =   								'2';

	/**
	 * GID.
	 *
	 * Global identifier.
	 *
	 * This attribute contains the global unique identifier. This value represents the value
	 * that uniquely identifies the object across domains and namespaces. This value is by
	 * definition a string and will generally constitute the object's primary key
	 * ({@link kTAG_NID}) in full or hashed form.
	 */
	const kTAG_GID =   								'3';

	/**
	 * UID.
	 *
	 * Unique identifier.
	 *
	 * This attribute contains the hashed unique identifier of an object in which its
	 * {@link kTAG_NID} is not related to the {@link kTAG_GID}. This is generally used when
	 * the {@link kTAG_NID} is a sequence number.
	 */
	const kTAG_UID =   								'4';

	/**
	 * PID.
	 *
	 * Persistent identifier.
	 *
	 * This attribute is used when an object needs a persistent identifier and it does not have
	 * a global or native identifier which is either unique or persistent. This attribute is
	 * set whenever a persistent identifier is needed to identify an object across
	 * implementations and this is not possible using other object attributes.
	 */
	const kTAG_PID =   								'5';

	/**
	 * CURRENT.
	 *
	 * Current identifier.
	 *
	 * This attribute is used when the current object is obsolete or superseeded, it holds a
	 * reference to the object that replaces the current one.
	 */
	const kTAG_CURRENT =   							'6';

	/**
	 * SYNONYMS.
	 *
	 * Synonyms.
	 *
	 * This attribute contains a list of strings that represent alternate identifiers for the
	 * hosting object. Synonyms do not have any relation to the namespace.
	 */
	const kTAG_SYNONYMS =   						'7';

	/*=======================================================================================
	 *	CLASSIFICATION ATTRIBUTES															*
	 *======================================================================================*/

	/**
	 * DOMAIN.
	 *
	 * Domain.
	 *
	 * This attribute is an enumerated set that contains the domain to which the hosting object
	 * belongs to.
	 */
	const kTAG_DOMAIN =   							'8';

	/**
	 * AUTHORITY.
	 *
	 * Authority.
	 *
	 * This attribute is an enumerated set that contains the authority to which the hosting
	 * object belongs to.
	 */
	const kTAG_AUTHORITY =   						'9';

	/**
	 * CATEGORY.
	 *
	 * Category.
	 *
	 * This attribute is an enumerated set that contains all the categories to which the hosting
	 * object belongs to.
	 */
	const kTAG_CATEGORY =   						'10';

	/**
	 * KIND.
	 *
	 * Kind.
	 *
	 * This attribute is an enumerated set that defines the kind of the hosting object.
	 */
	const kTAG_KIND =   							'11';

	/**
	 * TYPE.
	 *
	 * Type.
	 *
	 * This attribute is an enumerated set that contains a combination of data type and
	 * cardinality indicators which, combined, represet the data type of the hosting object.
	 */
	const kTAG_TYPE =   							'12';

	/**
	 * INDEX.
	 *
	 * Index.
	 *
	 * This attribute is an integer that represets the relative position of the object within
	 * its container.
	 */
	const kTAG_INDEX =   							'13';

	/**
	 * RANK.
	 *
	 * Rank.
	 *
	 * This attribute defines the rank of the object.
	 */
	const kTAG_RANK =   							'14';

	/**
	 * CLASS.
	 *
	 * Class.
	 *
	 * This attribute is a string that represets the referenced object's class. This attribute
	 * is used to instantiate the correct class once an object has been retrieved from its
	 * container.
	 */
	const kTAG_CLASS =   							'15';

	/*=======================================================================================
	 *	REPRESENTATION ATTRIBUTES															*
	 *======================================================================================*/

	/**
	 * INPUT.
	 *
	 * Input.
	 *
	 * This attribute represents the enumerated set for the suggested or preferred input type
	 * that should be used in a form to manage the value of the referenced property.
	 */
	const kTAG_INPUT =   							'16';

	/**
	 * PATTERN.
	 *
	 * Pattern.
	 *
	 * This attribute represents the regular expression pattern that can be used to validate the
	 * value of the referenced property.
	 */
	const kTAG_PATTERN =   							'17';

	/**
	 * LENGTH.
	 *
	 * Length.
	 *
	 * This attribute represents the maximum number of characters that may comprise the value of
	 * the referenced property.
	 */
	const kTAG_LENGTH =   							'18';

	/**
	 * MIN.
	 *
	 * Minimum value.
	 *
	 * This attribute represents the minimum value that the referenced property may hold.
	 */
	const kTAG_MIN_VAL =   							'19';

	/**
	 * MAX.
	 *
	 * Maximum value.
	 *
	 * This attribute represents the maximum value that the referenced property may hold.
	 */
	const kTAG_MAX_VAL =   							'20';

	/*=======================================================================================
	 *	DESCRIPTION ATTRIBUTES																*
	 *======================================================================================*/

	/**
	 * NAME.
	 *
	 * Name.
	 *
	 * This attribute represents the name of the referenced object.
	 * It is a {@link kTYPE_STRING} scalar which does not have a language component.
	 */
	const kTAG_NAME =   							'21';

	/**
	 * LABEL.
	 *
	 * Label.
	 *
	 * This attribute represents the label, name or short description of the referenced object.
	 * It is a {@link kTYPE_LSTRING} structure in which the label can be expressed in several
	 * languages.
	 */
	const kTAG_LABEL =   							'22';

	/**
	 * DEFINITION.
	 *
	 * Definition.
	 *
	 * This attribute represents the definition of the referenced object. It is an
	 * {@link kTYPE_LSTRING} structure in which the definition can be expressed in several
	+ languages. A definition is independent of the context.
	 */
	const kTAG_DEFINITION =   						'23';

	/**
	 * DESCRIPTION.
	 *
	 * Description.
	 *
	 * This attribute represents the description of the referenced object. It is an
	 * {@link kTYPE_LSTRING} structure in which the description can be expressed in several
	 * languages. A description depends on the context.
	 */
	const kTAG_DESCRIPTION =   						'24';

	/**
	 * NOTES.
	 *
	 * Notes.
	 *
	 * This attribute represents the notes or comments of the referenced object.
	 * It is a {@link kTYPE_LSTRING} structure in which the description can be expressed in
	 * several languages.
	 */
	const kTAG_NOTES =   							'25';

	/**
	 * EXAMPLES.
	 *
	 * Examples.
	 *
	 * This attribute represents the examples or templates of the referenced object.
	 * It is a list of strings where each string represents an example or template.
	 */
	const kTAG_EXAMPLES =   						'26';

	/*=======================================================================================
	 *	AUTHORSHIP ATTRIBUTES																*
	 *======================================================================================*/

	/**
	 * AUTHORS.
	 *
	 * Authors.
	 *
	 * This attribute represents a list of authors, it is an array of author names.
	 */
	const kTAG_AUTHORS =   							'27';

	/**
	 * ACKNOWLEDGMENTS.
	 *
	 * Acknowledgments.
	 *
	 * This attribute represents a list of generic acknowledgments, it is an array of strings.
	 */
	const kTAG_ACKNOWLEDGMENTS =   					'28';

	/**
	 * BIBLIOGRAPHY.
	 *
	 * Bibliography.
	 *
	 * This attribute represents a list of bibliographic references, it is an array of strings.
	 */
	const kTAG_BIBLIOGRAPHY =   					'29';

	/**
	 * VERSION.
	 *
	 * Version.
	 *
	 * This attribute represents the object's version.
	 */
	const kTAG_VERSION =   							'30';

	/*=======================================================================================
	 *	REFERENCE ATTRIBUTES																*
	 *======================================================================================*/

	/**
	 * UNIT.
	 *
	 * Unit.
	 *
	 * This attribute contains a reference to a unit object.
	 */
	const kTAG_UNIT =   							'31';

	/**
	 * ENTITY.
	 *
	 * Entity.
	 *
	 * This attribute contains a reference to an entity object.
	 */
	const kTAG_ENTITY =   							'32';

	/**
	 * TERM.
	 *
	 * Term.
	 *
	 * This attribute contains a reference to an object that represents the term of the
	 * attribute host.
	 */
	const kTAG_TERM =   							'33';

	/**
	 * NODE.
	 *
	 * Node.
	 *
	 * This attribute contains a reference to an object that represents the master node of the
	 * attribute host.
	 */
	const kTAG_NODE =   							'34';

	/**
	 * TAG.
	 *
	 * Tag.
	 *
	 * This attribute contains a reference to an object that represents a tag.
	 */
	const kTAG_TAG =   								'35';

	/**
	 * SUBJECT.
	 *
	 * Subject.
	 *
	 * This attribute contains a reference to an object that represents the start, origin or
	 * subject vertex of a <tt>subject</tt>/<tt>predicate</tt>/<tt>object</tt> relationship.
	 */
	const kTAG_SUBJECT =   							'36';

	/**
	 * kTAG_OBJECT.
	 *
	 * Object.
	 *
	 * This attribute contains a reference to an object that represents the end, destination or
	 * object vertex of a <tt>subject</tt>/<tt>predicate</tt>/<tt>object</tt> relationship.
	 */
	const kTAG_OBJECT =   							'37';

	/**
	 * PREDICATE.
	 *
	 * Predicate.
	 *
	 * This attribute contains a reference to an object that represents the predicate term of a
	 * <tt>subject</tt>/<tt>predicate</tt>/<tt>object</tt> relationship.
	 */
	const kTAG_PREDICATE =   						'38';

	/**
	 * PATH.
	 *
	 * Path.
	 *
	 * This attribute represents a sequence of <tt>vertex</tt>, <tt>predicate</tt>,
	 * <tt>vertex</tt> elements whose concatenation represents a path between an origin vertex
	 * and a destination vertex.
	 */
	const kTAG_PATH =   							'39';

	/*=======================================================================================
	 *	COLLECTION ATTRIBUTES																*
	 *======================================================================================*/

	/**
	 * NAMESPACE-REFS.
	 *
	 * Namespace references count.
	 *
	 * This integer attribute counts how many times external objects have referenced the current
	 * one as a namespace.
	 */
	const kTAG_NAMESPACE_REFS =   					'40';

	/**
	 * DATAPOINT-REFS.
	 *
	 * Data point references count.
	 *
	 * This integer attribute counts how many times the current tag was used to annotate data.
	 */
	const kTAG_DATAPOINT_REFS =   					'41';

	/**
	 * NODES.
	 *
	 * Nodes.
	 *
	 * This attribute is a collection of node references, it is an array of node object native
	 * identifiers who reference the current object.
	 */
	const kTAG_NODES =   							'42';

	/**
	 * EDGES.
	 *
	 * Edges.
	 *
	 * This attribute is a collection of edge references, it is an array of edge object native
	 * identifiers who reference the current object.
	 */
	const kTAG_EDGES =   							'43';

	/**
	 * TAGS.
	 *
	 * Tags.
	 *
	 * This attribute is a collection of tag references, it is an array of tag object native
	 * identifiers referenced by the current object.
	 */
	const kTAG_TAGS =   							'44';

	/**
	 * OFFSETS.
	 *
	 * Offsets.
	 *
	 * This attribute is a collection of offsets, that is, an array of strings representing a
	 * set of offsets.
	 */
	const kTAG_OFFSETS =   							'45';

	/**
	 * FEATURES.
	 *
	 * Features.
	 *
	 * This attribute is a collection of feature references, it is an array of object native
	 * identifiers that reference the current object as a feature or trait.
	 */
	const kTAG_FEATURES =   						'46';

	/**
	 * METHODS.
	 *
	 * Methods.
	 *
	 * This attribute is a collection of method references, it is an array of object native
	 * identifiers that reference the current object as a method or modifier.
	 */
	const kTAG_METHODS =   							'47';

	/**
	 * SCALES.
	 *
	 * Scales.
	 *
	 * This attribute is a collection of scale references, it is an array of object native
	 * identifiers that reference the current object as a scale or unit.
	 */
	const kTAG_SCALES =   							'48';

	/**
	 * MERGED.
	 *
	 * Merged.
	 *
	 * This attribute is a collection of tag references, it is used by tags common to several
	 * object domains, the value of the tags in this list is automatically set into the current
	 * tag.
	 */
	const kTAG_MERGED =   							'49';

	/*=======================================================================================
	 *	OBJECT CATEGORIES																	*
	 *======================================================================================*/

	/**
	 * INVENTORY.
	 *
	 * Inventory attributes.
	 */
	const kTAG_INVENTORY =   						'50';

	/**
	 * STATUS.
	 *
	 * Status attributes.
	 */
	const kTAG_STATUS =   			 				'51';

	/**
	 * EVENT.
	 *
	 * Event.
	 */
	const kTAG_EVENT =   							'52';

	/**
	 * OCCURRENCE.
	 *
	 * Occurrence.
	 */
	const kTAG_OCCURRENCE =   						'53';

	/**
	 * TAXON.
	 *
	 * Taxon attributes.
	 */
	const kTAG_TAXON =   							'54';

	/**
	 * LOCATION.
	 *
	 * Location attributes.
	 */
	const kTAG_LOCATION =   						'55';

	/**
	 * ENVIRONMENT.
	 *
	 * Environment attributes.
	 */
	const kTAG_ENVIRONMENT =   						'56';

	/**
	 * BIOCLIMATIC.
	 *
	 * Bio-climatic attributes.
	 */
	const kTAG_BIOCLIMATIC =   						'57';

	/**
	 * TEMPERATURE.
	 *
	 * Monthly temperature attributes.
	 */
	const kTAG_TEMPERATURE =   						'58';

	/**
	 * PRECIPITATION.
	 *
	 * Monthly precipitation attributes.
	 */
	const kTAG_PRECIPITATION =   					'59';

	/*=======================================================================================
	 *	INVENTORY ATTRIBUTES																*
	 *======================================================================================*/

	/**
	 * NICODE.
	 *
	 * National inventory.
	 */
	const kTAG_NICODE =   							'60';

	/**
	 * FAO:INSTCODE.
	 *
	 * Responsible institution.
	 */
	const kTAG_INSTCODE =   						'61';

	/*=======================================================================================
	 *	STATUS ATTRIBUTES																	*
	 *======================================================================================*/

	/**
	 * AVAILABLE.
	 *
	 * Available.
	 */
	const kTAG_AVAILABLE =   						'62';

	/*=======================================================================================
	 *	TAXON ATTRIBUTES																	*
	 *======================================================================================*/

	/**
	 * TAXON-NAME.
	 *
	 * Taxon name.
	 */
	const kTAG_TAXON_NAME =   						'63';

	/**
	 * TAXON-RANK.
	 *
	 * Taxon rank.
	 */
	const kTAG_TAXON_RANK =   						'64';

	/**
	 * CROP.
	 *
	 * Taxon crop.
	 */
	const kTAG_CROP =   							'65';

	/**
	 * ANNEX1.
	 *
	 * Taxon name.
	 */
	const kTAG_ANNEX1 =   							'66';

	/*=======================================================================================
	 *	LOCATION ATTRIBUTES																	*
	 *======================================================================================*/

	/**
	 * COORDINATES.
	 *
	 * Location coordinates.
	 */
	const kTAG_COORDINATES =   						'67';

	/*=======================================================================================
	 *	ENVIRONMENT ATTRIBUTES																*
	 *======================================================================================*/

	/**
	 * GENS.
	 *
	 * Global Environment Stratification.
	 */
	const kTAG_GENS =   							'68';

	/**
	 * GENS-CLIM.
	 *
	 * Climatic Zone.
	 */
	const kTAG_GENS_CLIM =   						'69';

	/**
	 * GENS-ENV.
	 *
	 * Environmental Zone.
	 */
	const kTAG_GENS_ENV =   						'70';

	/*=======================================================================================
	 *	BIO-CLIMATIC ATTRIBUTES																*
	 *======================================================================================*/

	/**
	 * BIO1.
	 *
	 * Annual Mean Temperature.
	 *
	 * Annual mean temperature (C° × 10).
	 */
	const kTAG_BIO1 =   							'71';

	/**
	 * BIO2.
	 *
	 * Mean Diurnal Range.
	 *
	 * Mean diurnal range: mean of monthly (max temp - min temp) (C° × 10).
	 */
	const kTAG_BIO2 =   							'72';

	/**
	 * BIO3.
	 *
	 * Isothermality.
	 *
	 * Isothermality ((Mean Diurnal Range / Temperature Annual Range) × 100).
	 */
	const kTAG_BIO3 =   							'73';

	/**
	 * BIO4.
	 *
	 * Temperature Seasonality.
	 *
	 * Temperature seasonality (standard deviation × 100).
	 */
	const kTAG_BIO4 =   							'74';

	/**
	 * BIO5.
	 *
	 * Maximum Temperature of Warmest Month.
	 *
	 * Maximum temperature of warmest month (C° × 10).
	 */
	const kTAG_BIO5 =   							'75';

	/**
	 * BIO6.
	 *
	 * Minimum Temperature of Coldest Month.
	 *
	 * Minimum temperature of coldest month (C° × 10).
	 */
	const kTAG_BIO6 =   							'76';

	/**
	 * BIO7.
	 *
	 * Temperature Annual Range.
	 *
	 * Temperature annual range (Maximum Temperature of Warmest Month - Minimum Temperature of
	 * Coldest Month).
	 */
	const kTAG_BIO7 =   							'77';

	/**
	 * BIO8.
	 *
	 * Mean Temperature of Wettest Quarter.
	 *
	 * Mean temperature of wettest quarter (C° × 10).
	 */
	const kTAG_BIO8 =   							'78';

	/**
	 * BIO9.
	 *
	 * Mean Temperature of Driest Quarter.
	 *
	 * Mean temperature of driest quarter (C° × 10).
	 */
	const kTAG_BIO9 =   							'79';

	/**
	 * BIO10.
	 *
	 * Mean Temperature of Warmest Quarter.
	 *
	 * Mean temperature of warmest quarter (C° × 10).
	 */
	const kTAG_BIO10 =   							'80';

	/**
	 * BIO11.
	 *
	 * Mean Temperature of Coldest Quarter.
	 *
	 * Mean temperature of coldest quarter (C° × 10).
	 */
	const kTAG_BIO11 =   							'81';

	/**
	 * BIO12.
	 *
	 * Annual Precipitation.
	 */
	const kTAG_BIO12 =   							'82';

	/**
	 * BIO13.
	 *
	 * Precipitation of Wettest Month.
	 */
	const kTAG_BIO13 =   							'83';

	/**
	 * BIO14.
	 *
	 * Precipitation of Driest Month.
	 */
	const kTAG_BIO14 =   							'84';

	/**
	 * BIO15.
	 *
	 * Precipitation Seasonality.
	 *
	 * Precipitation seasonality (Coefficient of Variation).
	 */
	const kTAG_BIO15 =   							'85';

	/**
	 * BIO16.
	 *
	 * Precipitation of Wettest Quarter.
	 */
	const kTAG_BIO16 =   							'86';

	/**
	 * BIO17.
	 *
	 * Precipitation of Driest Quarter.
	 */
	const kTAG_BIO17 =   							'87';

	/**
	 * BIO18.
	 *
	 * Precipitation of Warmest Quarter.
	 */
	const kTAG_BIO18 =   							'88';

	/**
	 * BIO19.
	 *
	 * Precipitation of Coldest Quarter.
	 */
	const kTAG_BIO19 =   							'89';

	/*=======================================================================================
	 *	MONTHLY TEMPERATURE ATTRIBUTES														*
	 *======================================================================================*/

	/**
	 * TEMP01.
	 *
	 * January mean temperature.
	 *
	 * January mean temperature (C° × 10).
	 */
	const kTAG_TEMP01 =   							'90';

	/**
	 * TEMP01-MIN.
	 *
	 * January minimum temperature.
	 *
	 * January minimum temperature (C° × 10).
	 */
	const kTAG_TEMP01_MIN =   						'91';

	/**
	 * TEMP01-MAX.
	 *
	 * January maximum temperature.
	 *
	 * January maximum temperature (C° × 10).
	 */
	const kTAG_TEMP01_MAX =   						'92';

	/**
	 * TEMP02.
	 *
	 * February mean temperature.
	 *
	 * February mean temperature (C° × 10).
	 */
	const kTAG_TEMP02 =   							'93';

	/**
	 * TEMP02-MIN.
	 *
	 * February minimum temperature.
	 *
	 * February minimum temperature (C° × 10).
	 */
	const kTAG_TEMP02_MIN =   						'94';

	/**
	 * TEMP02-MAX.
	 *
	 * February maximum temperature.
	 *
	 * February maximum temperature (C° × 10).
	 */
	const kTAG_TEMP02_MAX =   						'95';

	/**
	 * TEMP03.
	 *
	 * March mean temperature.
	 *
	 * March mean temperature (C° × 10).
	 */
	const kTAG_TEMP03 =   							'96';

	/**
	 * TEMP03-MIN.
	 *
	 * March minimum temperature.
	 *
	 * March minimum temperature (C° × 10).
	 */
	const kTAG_TEMP03_MIN =   						'97';

	/**
	 * TEMP03-MAX.
	 *
	 * March maximum temperature.
	 *
	 * March maximum temperature (C° × 10).
	 */
	const kTAG_TEMP03_MAX =   						'98';

	/**
	 * TEMP04.
	 *
	 * April mean temperature.
	 *
	 * April mean temperature (C° × 10).
	 */
	const kTAG_TEMP04 =   							'99';

	/**
	 * TEMP04-MIN.
	 *
	 * April minimum temperature.
	 *
	 * April minimum temperature (C° × 10).
	 */
	const kTAG_TEMP04_MIN =   						'199';

	/**
	 * TEMP04-MAX.
	 *
	 * April maximum temperature.
	 *
	 * April maximum temperature (C° × 10).
	 */
	const kTAG_TEMP04_MAX =   						'101';

	/**
	 * TEMP05.
	 *
	 * May mean temperature.
	 *
	 * May mean temperature (C° × 10).
	 */
	const kTAG_TEMP05 =   							'102';

	/**
	 * TEMP05-MIN.
	 *
	 * May minimum temperature.
	 *
	 * May minimum temperature (C° × 10).
	 */
	const kTAG_TEMP05_MIN =   						'103';

	/**
	 * TEMP05-MAX.
	 *
	 * May maximum temperature.
	 *
	 * May maximum temperature (C° × 10).
	 */
	const kTAG_TEMP05_MAX =   						'104';

	/**
	 * TEMP06.
	 *
	 * June mean temperature.
	 *
	 * June mean temperature (C° × 10).
	 */
	const kTAG_TEMP06 =   							'105';

	/**
	 * TEMP06-MIN.
	 *
	 * June minimum temperature.
	 *
	 * June minimum temperature (C° × 10).
	 */
	const kTAG_TEMP06_MIN =   						'106';

	/**
	 * TEMP06-MAX.
	 *
	 * June maximum temperature.
	 *
	 * June maximum temperature (C° × 10).
	 */
	const kTAG_TEMP06_MAX =   						'107';

	/**
	 * TEMP07.
	 *
	 * July mean temperature.
	 *
	 * July mean temperature (C° × 10).
	 */
	const kTAG_TEMP07 =   							'108';

	/**
	 * TEMP07-MIN.
	 *
	 * July minimum temperature.
	 *
	 * July minimum temperature (C° × 10).
	 */
	const kTAG_TEMP07_MIN =   						'109';

	/**
	 * TEMP07-MAX.
	 *
	 * July maximum temperature.
	 *
	 * July maximum temperature (C° × 10).
	 */
	const kTAG_TEMP07_MAX =   						'110';

	/**
	 * TEMP08.
	 *
	 * August mean temperature.
	 *
	 * August mean temperature (C° × 10).
	 */
	const kTAG_TEMP08 =   							'111';

	/**
	 * TEMP08-MIN.
	 *
	 * August minimum temperature.
	 *
	 * August minimum temperature (C° × 10).
	 */
	const kTAG_TEMP08_MIN =   						'112';

	/**
	 * TEMP08-MAX.
	 *
	 * August maximum temperature.
	 *
	 * August maximum temperature (C° × 10).
	 */
	const kTAG_TEMP08_MAX =   						'113';

	/**
	 * TEMP09.
	 *
	 * September mean temperature.
	 *
	 * September mean temperature (C° × 10).
	 */
	const kTAG_TEMP09 =   							'114';

	/**
	 * TEMP09-MIN.
	 *
	 * September minimum temperature.
	 *
	 * September minimum temperature (C° × 10).
	 */
	const kTAG_TEMP09_MIN =   						'115';

	/**
	 * TEMP09-MAX.
	 *
	 * September maximum temperature.
	 *
	 * September maximum temperature (C° × 10).
	 */
	const kTAG_TEMP09_MAX =   						'116';

	/**
	 * TEMP10.
	 *
	 * October mean temperature.
	 *
	 * October mean temperature (C° × 10).
	 */
	const kTAG_TEMP10 =   							'117';

	/**
	 * TEMP10-MIN.
	 *
	 * October minimum temperature.
	 *
	 * October minimum temperature (C° × 10).
	 */
	const kTAG_TEMP10_MIN =   						'118';

	/**
	 * TEMP10-MAX.
	 *
	 * October maximum temperature.
	 *
	 * October maximum temperature (C° × 10).
	 */
	const kTAG_TEMP10_MAX =   						'119';

	/**
	 * TEMP11.
	 *
	 * November mean temperature.
	 *
	 * November mean temperature (C° × 10).
	 */
	const kTAG_TEMP11 =   							'120';

	/**
	 * TEMP11-MIN.
	 *
	 * November minimum temperature.
	 *
	 * November minimum temperature (C° × 10).
	 */
	const kTAG_TEMP11_MIN =   						'121';

	/**
	 * TEMP11-MAX.
	 *
	 * November maximum temperature.
	 *
	 * November maximum temperature (C° × 10).
	 */
	const kTAG_TEMP11_MAX =   						'122';

	/**
	 * TEMP12.
	 *
	 * December mean temperature.
	 *
	 * December mean temperature (C° × 10).
	 */
	const kTAG_TEMP12 =   							'123';

	/**
	 * TEMP12-MIN.
	 *
	 * December minimum temperature.
	 *
	 * December minimum temperature (C° × 10).
	 */
	const kTAG_TEMP12_MIN =   						'124';

	/**
	 * TEMP12-MAX.
	 *
	 * December maximum temperature.
	 *
	 * December maximum temperature (C° × 10).
	 */
	const kTAG_TEMP12_MAX =   						'125';

	/*=======================================================================================
	 *	MONTHLY PRECIPITATION ATTRIBUTES													*
	 *======================================================================================*/

	/**
	 * PREC01.
	 *
	 * January precipitation.
	 *
	 * January precipitation (mm.).
	 */
	const kTAG_PREC01 =   							'126';

	/**
	 * PREC02.
	 *
	 * February precipitation.
	 *
	 * February precipitation (mm.).
	 */
	const kTAG_PREC02 =   							'127';

	/**
	 * PREC03.
	 *
	 * March precipitation.
	 *
	 * February precipitation (mm.).
	 */
	const kTAG_PREC03 =   							'128';

	/**
	 * PREC04.
	 *
	 * April precipitation.
	 *
	 * January precipitation (mm.).
	 */
	const kTAG_PREC04 =   							'129';

	/**
	 * PREC05.
	 *
	 * May precipitation.
	 *
	 * May precipitation (mm.).
	 */
	const kTAG_PREC05 =   							'130';

	/**
	 * PREC06.
	 *
	 * June precipitation.
	 *
	 * June precipitation (mm.).
	 */
	const kTAG_PREC06 =   							'131';

	/**
	 * PREC07.
	 *
	 * July precipitation.
	 *
	 * July precipitation (mm.).
	 */
	const kTAG_PREC07 =   							'132';

	/**
	 * PREC08.
	 *
	 * August precipitation.
	 *
	 * August precipitation (mm.).
	 */
	const kTAG_PREC08 =   							'133';

	/**
	 * PREC09.
	 *
	 * September precipitation.
	 *
	 * September precipitation (mm.).
	 */
	const kTAG_PREC09 =   							'134';

	/**
	 * PREC10.
	 *
	 * October precipitation.
	 *
	 * October precipitation (mm.).
	 */
	const kTAG_PREC10 =   							'135';

	/**
	 * PREC11.
	 *
	 * November precipitation.
	 *
	 * November precipitation (mm.).
	 */
	const kTAG_PREC11 =   							'136';

	/**
	 * PREC12.
	 *
	 * December precipitation.
	 *
	 * December precipitation (mm.).
	 */
	const kTAG_PREC12 =   							'137';

	/*=======================================================================================
	 *	ENTITY OBJECT ATTRIBUTES															*
	 *======================================================================================*/

	/**
	 * FIRST-NAME.
	 *
	 * Entity first name.
	 *
	 * The entity first name, in case of an individual.
	 */
	const kTAG_FIRST_NAME =   						'138';

	/**
	 * LAST-NAME.
	 *
	 * Entity last name.
	 *
	 * The entity surname, in case of an individual.
	 */
	const kTAG_LAST_NAME =   						'139';

	/**
	 * MAIL.
	 *
	 * Entity mail.
	 *
	 * The mailing address of an entity.
	 */
	const kTAG_MAIL =   							'140';

	/**
	 * EMAIL.
	 *
	 * Entity e-mail.
	 *
	 * The e-mail address of an entity.
	 */
	const kTAG_EMAIL =   							'141';

	/**
	 * PHONE.
	 *
	 * Entity phone.
	 *
	 * The telephone number of an entity.
	 */
	const kTAG_PHONE =   							'142';

	/**
	 * FAX.
	 *
	 * Entity fax.
	 *
	 * The telefax number of an entity.
	 */
	const kTAG_FAX =   								'143';

	/**
	 * WEB-SITE.
	 *
	 * Entity web site.
	 *
	 * The entity internet web site address.
	 */
	const kTAG_WEB_SITE =   						'144';

	/**
	 * AFFILIATION.
	 *
	 * Entity affiliation.
	 *
	 * The reference to the entity with which the current entity is affiliated.
	 */
	const kTAG_AFFILIATION =   						'145';

	/**
	 * NATIONALITY.
	 *
	 * Nationality.
	 *
	 * The country of an entity.
	 */
	const kTAG_NATIONALITY =   						'146';

	/**
	 * ENTITY-KIND.
	 *
	 * Entity kind.
	 *
	 * The entity kind.
	 */
	const kTAG_ENTITY_KIND =   						'147';

	/**
	 * ENTITY-TYPE.
	 *
	 * Entity type.
	 *
	 * The entity type.
	 */
	const kTAG_ENTITY_TYPE =   						'148';

	/*=======================================================================================
	 *	USER OBJECT ATTRIBUTES																*
	 *======================================================================================*/

	/**
	 * USER-CODE.
	 *
	 * User code.
	 *
	 * The code by which a user is known to the system, it may be equal to the entity
	 * identifier.
	 */
	const kTAG_USER_CODE =   						'149';

	/**
	 * USER-PASS.
	 *
	 * User password.
	 *
	 * The password by which a user is known to the system.
	 */
	const kTAG_USER_PASS =   						'150';

	/**
	 * USER-ROLE.
	 *
	 * User roles.
	 *
	 * The roles assigned to the user.
	 */
	const kTAG_USER_ROLE =   						'151';

	/**
	 * USER-PROFILE.
	 *
	 * User profile.
	 *
	 * The profile role name assigned to the user.
	 */
	const kTAG_USER_PROFILE =   					'152';

	/**
	 * USER-DOMAIN.
	 *
	 * User domain.
	 *
	 * List of domains the user has access to.
	 */
	const kTAG_USER_DOMAIN =   						'153';

	/**
	 * USER-SOCIAL-NETWORK.
	 *
	 * User social network.
	 */
	const kTAG_USER_SOCIAL_NETWORK =   				'154';

	/*=======================================================================================
	 *	CUSTOM TYPE SUB ATTRIBUTES															*
	 *======================================================================================*/

	/**
	 * type.
	 *
	 * Custom data object type.
	 *
	 * This tag is used as the default offset for indicating a custom data type, in general it
	 * is used in a structure in conjunction with the {@link kTAG_CUSTOM_DATA} offset to
	 * indicate the data type of the item.
	 *
	 * Version 1: (kTAG_CUSTOM_TYPE)[type]
	 */
	const kTAG_CUSTOM_TYPE =   						'type';

	/**
	 * data.
	 *
	 * Custom data object data.
	 *
	 * This tag is used as the default offset for indicating a custom data type content, in
	 * general this tag is used in conjunction with the {@link kTAG_CUSTOM_TYPE} to wrap a
	 * custom data type in a standard structure.
	 *
	 * Version 1: (kTAG_CUSTOM_DATA)[data]
	 */
	const kTAG_CUSTOM_DATA =   						'data';

	/*=======================================================================================
	 *	CUSTOM TIMESTAMP SUB-ATTRIBUTES														*
	 *======================================================================================*/

	/**
	 * sec.
	 *
	 * Seconds.
	 *
	 * This tag defines the number of seconds since January 1st, 1970.
	 *
	 * Version 1: (kTYPE_STAMP_SEC)[sec]
	 */
	const kTAG_STAMP_SEC =   						'sec';

	/**
	 * usec.
	 *
	 * Microseconds.
	 *
	 * This tag defines microseconds.
	 *
	 * Version 1: (kTYPE_STAMP_USEC)[usec]
	 */
	const kTAG_STAMP_USEC =   						'usec';

	/*=======================================================================================
	 *	CUSTOM TYPED LIST SUB-ATTRIBUTES													*
	 *======================================================================================*/

	/**
	 * t.
	 *
	 * Type.
	 *
	 * This tag defines the typed list element type offset.
	 *
	 * Version 1: (kTAG_TYPED_TYPE)[tp]
	 */
	const kTAG_TYPED_TYPE =   						'tp';

	/**
	 * d.
	 *
	 * Data.
	 *
	 * This tag defines the typed list element data offset.
	 *
	 * Version 1: (kTAG_TYPED_DATA)[dt]
	 */
	const kTAG_TYPED_DATA =   						'dt';

	/*=======================================================================================
	 *	CUSTOM RANGE SUB-ATTRIBUTES															*
	 *======================================================================================*/

	/**
	 * l.
	 *
	 * Minimum.
	 *
	 * This tag defines the minimum value offset.
	 *
	 * Version 1: (kTAG_RANGE_MIN)[l]
	 */
	const kTAG_RANGE_MIN =   						'l';

	/**
	 * m.
	 *
	 * Mean.
	 *
	 * This tag defines the mean value offset.
	 *
	 * Version 1: (kTAG_RANGE_MEAN)[m]
	 */
	const kTAG_RANGE_MEAN =   						'm';

	/**
	 * h.
	 *
	 * Maximum.
	 *
	 * This tag defines the maximum value offset.
	 *
	 * Version 1: (kTAG_RANGE_MAX)[h]
	 */
	const kTAG_RANGE_MAX =   						'h';

   
  /**
   * Returns the tags language list
   * @param string $tags
   *  
   * @return array $serverResponce
   */
  public function getTags($tags)
  {
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GetTag');
    $requestManager->setQuery(Tags::kTAG_NID, Types::kTYPE_INT, $tags, Operators::kOPERATOR_IN);
    
    return $requestManager->sendRequest();
  }

  /**
   * This method return the server response for requested tag
   * @param string $tag
   * @param const $field (es: Tags::kTAG_GID)
   *
   * @return array $requestManager
   */
  public function getTagBy($tag, $field)
  {
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GetTag');
    $requestManager->setCollection(':_tags');
    $requestManager->setPageLimit(50);
    $requestManager->setQuery($field, Types::kTYPE_STRING, $tag, Operators::kOPERATOR_EQUAL);
    
    return $requestManager->sendRequest();
  }
}
