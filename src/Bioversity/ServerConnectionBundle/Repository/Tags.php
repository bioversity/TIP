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
	 * COLLECTION.
	 *
	 * Collection.
	 *
	 * This string attribute represents the collection identifier, it acts as a namespace for
	 * identifiers and as a collection for objects.
	 */
	const kTAG_COLLECTION =   						'10';

	/**
	 * CATEGORY.
	 *
	 * Category.
	 *
	 * This attribute is an enumerated set that contains all the categories to which the hosting
	 * object belongs to.
	 */
	const kTAG_CATEGORY =   						'11';

	/**
	 * KIND.
	 *
	 * Kind.
	 *
	 * This attribute is an enumerated set that defines the kind of the hosting object.
	 */
	const kTAG_KIND =   							'12';

	/**
	 * TYPE.
	 *
	 * Type.
	 *
	 * This attribute is an enumerated set that contains a combination of data type and
	 * cardinality indicators which, combined, represet the data type of the hosting object.
	 */
	const kTAG_TYPE =   							'13';

	/**
	 * INDEX.
	 *
	 * Index.
	 *
	 * This attribute is an integer that represets the relative position of the object within
	 * its container.
	 */
	const kTAG_INDEX =   							'14';

	/**
	 * RANK.
	 *
	 * Rank.
	 *
	 * This attribute defines the rank of the object.
	 */
	const kTAG_RANK =   							'15';

	/**
	 * CLASS.
	 *
	 * Class.
	 *
	 * This attribute is a string that represets the referenced object's class. This attribute
	 * is used to instantiate the correct class once an object has been retrieved from its
	 * container.
	 */
	const kTAG_CLASS =   							'16';

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
	const kTAG_INPUT =   							'17';

	/**
	 * PATTERN.
	 *
	 * Pattern.
	 *
	 * This attribute represents the regular expression pattern that can be used to validate the
	 * value of the referenced property.
	 */
	const kTAG_PATTERN =   							'18';

	/**
	 * LENGTH.
	 *
	 * Length.
	 *
	 * This attribute represents the maximum number of characters that may comprise the value of
	 * the referenced property.
	 */
	const kTAG_LENGTH =   							'19';

	/**
	 * MIN.
	 *
	 * Minimum value.
	 *
	 * This attribute represents the minimum value that the referenced property may hold.
	 */
	const kTAG_MIN_VAL =   							'20';

	/**
	 * MAX.
	 *
	 * Maximum value.
	 *
	 * This attribute represents the maximum value that the referenced property may hold.
	 */
	const kTAG_MAX_VAL =   							'21';

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
	const kTAG_NAME =   							'22';

	/**
	 * LABEL.
	 *
	 * Label.
	 *
	 * This attribute represents the label, name or short description of the referenced object.
	 * It is a {@link kTYPE_LSTRING} structure in which the label can be expressed in several
	 * languages.
	 */
	const kTAG_LABEL =   							'23';

	/**
	 * DEFINITION.
	 *
	 * Definition.
	 *
	 * This attribute represents the definition of the referenced object. It is an
	 * {@link kTYPE_LSTRING} structure in which the definition can be expressed in several
	+ languages. A definition is independent of the context.
	 */
	const kTAG_DEFINITION =   						'24';

	/**
	 * DESCRIPTION.
	 *
	 * Description.
	 *
	 * This attribute represents the description of the referenced object. It is an
	 * {@link kTYPE_LSTRING} structure in which the description can be expressed in several
	 * languages. A description depends on the context.
	 */
	const kTAG_DESCRIPTION =   						'25';

	/**
	 * NOTES.
	 *
	 * Notes.
	 *
	 * This attribute represents the notes or comments of the referenced object.
	 * It is a {@link kTYPE_LSTRING} structure in which the description can be expressed in
	 * several languages.
	 */
	const kTAG_NOTES =   							'26';

	/**
	 * EXAMPLES.
	 *
	 * Examples.
	 *
	 * This attribute represents the examples or templates of the referenced object.
	 * It is a list of strings where each string represents an example or template.
	 */
	const kTAG_EXAMPLES =   						'27';

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
	const kTAG_AUTHORS =   							'28';

	/**
	 * ACKNOWLEDGMENTS.
	 *
	 * Acknowledgments.
	 *
	 * This attribute represents a list of generic acknowledgments, it is an array of strings.
	 */
	const kTAG_ACKNOWLEDGMENTS =   					'29';

	/**
	 * BIBLIOGRAPHY.
	 *
	 * Bibliography.
	 *
	 * This attribute represents a list of bibliographic references, it is an array of strings.
	 */
	const kTAG_BIBLIOGRAPHY =   					'30';

	/**
	 * VERSION.
	 *
	 * Version.
	 *
	 * This attribute represents the object's version.
	 */
	const kTAG_VERSION =   							'31';

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
	const kTAG_UNIT =   							'32';

	/**
	 * ENTITY.
	 *
	 * Entity.
	 *
	 * This attribute contains a reference to an entity object.
	 */
	const kTAG_ENTITY =   							'33';

	/**
	 * TERM.
	 *
	 * Term.
	 *
	 * This attribute contains a reference to an object that represents the term of the
	 * attribute host.
	 */
	const kTAG_TERM =   							'34';

	/**
	 * NODE.
	 *
	 * Node.
	 *
	 * This attribute contains a reference to an object that represents the master node of the
	 * attribute host.
	 */
	const kTAG_NODE =   							'35';

	/**
	 * TAG.
	 *
	 * Tag.
	 *
	 * This attribute contains a reference to an object that represents a tag.
	 */
	const kTAG_TAG =   								'36';

	/**
	 * SUBJECT.
	 *
	 * Subject.
	 *
	 * This attribute contains a reference to an object that represents the start, origin or
	 * subject vertex of a <tt>subject</tt>/<tt>predicate</tt>/<tt>object</tt> relationship.
	 */
	const kTAG_SUBJECT =   							'37';

	/**
	 * kTAG_OBJECT.
	 *
	 * Object.
	 *
	 * This attribute contains a reference to an object that represents the end, destination or
	 * object vertex of a <tt>subject</tt>/<tt>predicate</tt>/<tt>object</tt> relationship.
	 */
	const kTAG_OBJECT =   							'38';

	/**
	 * PREDICATE.
	 *
	 * Predicate.
	 *
	 * This attribute contains a reference to an object that represents the predicate term of a
	 * <tt>subject</tt>/<tt>predicate</tt>/<tt>object</tt> relationship.
	 */
	const kTAG_PREDICATE =   						'39';

	/**
	 * PATH.
	 *
	 * Path.
	 *
	 * This attribute represents a sequence of <tt>vertex</tt>, <tt>predicate</tt>,
	 * <tt>vertex</tt> elements whose concatenation represents a path between an origin vertex
	 * and a destination vertex.
	 */
	const kTAG_PATH =   							'40';

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
	const kTAG_NAMESPACE_REFS =   					'41';

	/**
	 * DATAPOINT-REFS.
	 *
	 * Data point references count.
	 *
	 * This integer attribute counts how many times the current tag was used to annotate data.
	 */
	const kTAG_DATAPOINT_REFS =   					'42';

	/**
	 * NODES.
	 *
	 * Nodes.
	 *
	 * This attribute is a collection of node references, it is an array of node object native
	 * identifiers who reference the current object.
	 */
	const kTAG_NODES =   							'43';

	/**
	 * EDGES.
	 *
	 * Edges.
	 *
	 * This attribute is a collection of edge references, it is an array of edge object native
	 * identifiers who reference the current object.
	 */
	const kTAG_EDGES =   							'44';

	/**
	 * TAGS.
	 *
	 * Tags.
	 *
	 * This attribute is a collection of tag references, it is an array of tag object native
	 * identifiers referenced by the current object.
	 */
	const kTAG_TAGS =   							'45';

	/**
	 * OFFSETS.
	 *
	 * Offsets.
	 *
	 * This attribute is a collection of offsets, that is, an array of strings representing a
	 * set of offsets.
	 */
	const kTAG_OFFSETS =   							'46';

	/**
	 * FEATURES.
	 *
	 * Features.
	 *
	 * This attribute is a collection of feature references, it is an array of object native
	 * identifiers that reference the current object as a feature or trait.
	 */
	const kTAG_FEATURES =   						'47';

	/**
	 * METHODS.
	 *
	 * Methods.
	 *
	 * This attribute is a collection of method references, it is an array of object native
	 * identifiers that reference the current object as a method or modifier.
	 */
	const kTAG_METHODS =   							'48';

	/**
	 * SCALES.
	 *
	 * Scales.
	 *
	 * This attribute is a collection of scale references, it is an array of object native
	 * identifiers that reference the current object as a scale or unit.
	 */
	const kTAG_SCALES =   							'49';

	/**
	 * MERGED.
	 *
	 * Merged.
	 *
	 * This attribute is a collection of tag references, it is used by tags common to several
	 * object domains, the value of the tags in this list is automatically set into the current
	 * tag.
	 */
	const kTAG_MERGED =   							'50';

	/*=======================================================================================
	 *	OBJECT CATEGORIES																	*
	 *======================================================================================*/

	/**
	 * INVENTORY.
	 *
	 * Inventory attributes.
	 */
	const kTAG_INVENTORY =   						'51';

	/**
	 * STATUS.
	 *
	 * Status attributes.
	 */
	const kTAG_STATUS =   			 				'52';

	/**
	 * EVENT.
	 *
	 * Event.
	 */
	const kTAG_EVENT =   							'53';

	/**
	 * OCCURRENCE.
	 *
	 * Occurrence.
	 */
	const kTAG_OCCURRENCE =   						'54';

	/**
	 * TAXON.
	 *
	 * Taxon attributes.
	 */
	const kTAG_TAXON =   							'55';

	/**
	 * CROSSABILITY.
	 *
	 * Crossability.
	 */
	const kTAG_CROSS =   							'56';

	/**
	 * LOCATION.
	 *
	 * Location attributes.
	 */
	const kTAG_LOCATION =   						'57';

	/**
	 * ENVIRONMENT.
	 *
	 * Environment attributes.
	 */
	const kTAG_ENVIRONMENT =   						'58';

	/**
	 * BIOCLIMATIC.
	 *
	 * Bio-climatic attributes.
	 */
	const kTAG_BIOCLIMATIC =   						'59';

	/**
	 * TEMPERATURE.
	 *
	 * Monthly temperature attributes.
	 */
	const kTAG_TEMPERATURE =   						'60';

	/**
	 * PRECIPITATION.
	 *
	 * Monthly precipitation attributes.
	 */
	const kTAG_PRECIPITATION =   					'61';

	/*=======================================================================================
	 *	INVENTORY ATTRIBUTES																*
	 *======================================================================================*/

	/**
	 * NICODE.
	 *
	 * National inventory.
	 */
	const kTAG_NICODE =   							'62';

	/**
	 * FAO:INSTCODE.
	 *
	 * Responsible institution.
	 */
	const kTAG_INSTCODE =   						'63';

	/*=======================================================================================
	 *	STATUS ATTRIBUTES																	*
	 *======================================================================================*/

	/**
	 * AVAILABLE.
	 *
	 * Available.
	 */
	const kTAG_AVAILABLE =   						'64';

	/**
	 * RESTRICTIONS.
	 *
	 * Restrictions.
	 */
	const kTAG_RESTRICTIONS =   					'65';

	/*=======================================================================================
	 *	TAXON ATTRIBUTES																	*
	 *======================================================================================*/

	/**
	 * TAXON-NAME.
	 *
	 * Taxon name.
	 */
	const kTAG_TAXON_NAME =   						'66';

	/**
	 * TAXON-RANK.
	 *
	 * Taxon rank.
	 */
	const kTAG_TAXON_RANK =   						'67';

	/**
	 * CROP.
	 *
	 * Taxon crop.
	 */
	const kTAG_CROP =   							'68';

	/**
	 * ANNEX1.
	 *
	 * Taxon name.
	 */
	const kTAG_ANNEX1 =   							'69';

	/*=======================================================================================
	 *	CROSSABILITY ATTRIBUTES																*
	 *======================================================================================*/

	/**
	 * LISTSPCROSS.
	 *
	 * List of species crosses.
	 */
	const kTAG_LISTSPCROSS =   						'70';

	/**
	 * LISTSPCROSSREF.
	 *
	 * List of species crosses references.
	 */
	const kTAG_LISTSPCROSSREF =   					'71';

	/**
	 * METHCROSSREF.
	 *
	 * Method used for crosses.
	 */
	const kTAG_METHCROSSREF =   					'72';

	/**
	 * SUCCROSSREF.
	 *
	 * Success rate of crosses.
	 */
	const kTAG_SUCCROSSREF =   						'73';

	/*=======================================================================================
	 *	LOCATION ATTRIBUTES																	*
	 *======================================================================================*/

	/**
	 * COORDINATES.
	 *
	 * Location coordinates.
	 */
	const kTAG_COORDINATES =   						'74';

	/**
	 * LATITUDE-DISPLAY.
	 *
	 * Location display latitude.
	 *
	 * This attribute represents the display latitude, that is, the latitude that should be
	 * displayed on a map. This is useful in cases where there are coordinates restrictions:
	 * when displaying a point on a map, this coordinate will be used in place of the true
	 * coordinate.
	 */
	const kTAG_LATITUDE_DISPLAY =   				'75';

	/**
	 * LONGITUDE-DISPLAY.
	 *
	 * Location display longitude.
	 *
	 * This attribute represents the display longitude, that is, the longitude that should be
	 * displayed on a map. This is useful in cases where there are coordinates restrictions:
	 * when displaying a point on a map, this coordinate will be used in place of the true
	 * coordinate.
	 */
	const kTAG_LONGITUDE_DISPLAY =   				'76';

	/*=======================================================================================
	 *	ENVIRONMENT ATTRIBUTES																*
	 *======================================================================================*/

	/**
	 * GENS.
	 *
	 * Global Environment Stratification.
	 */
	const kTAG_GENS =   							'77';

	/**
	 * GENS-CLIM.
	 *
	 * Climatic Zone.
	 */
	const kTAG_GENS_CLIM =   						'78';

	/**
	 * GENS-ENV.
	 *
	 * Environmental Zone.
	 */
	const kTAG_GENS_ENV =   						'79';

	/**
	 * CLIM-ELEV-MIN.
	 *
	 * Minimum environment elevation.
	 *
	 * This attribute records the minimum elevation of the climatic area, that is, the minimum
	 * elevation found when retrieving climatic data.
	 */
	const kTAG_CLIM_ELEV_MIN =   					'80';

	/**
	 * CLIM-ELEV-MEAN.
	 *
	 * Mean environment elevation.
	 *
	 * This attribute records the mean elevation of the climatic area, that is, the mean
	 * elevation found when retrieving climatic data.
	 */
	const kTAG_CLIM_ELEV_MEAN =   					'81';

	/**
	 * CLIM-ELEV-MAX.
	 *
	 * Maximum environment elevation.
	 *
	 * This attribute records the maximum elevation of the climatic area, that is, the maximum
	 * elevation found when retrieving climatic data.
	 */
	const kTAG_CLIM_ELEV_MAX =   					'82';

	/**
	 * CLIM-DIST-MIN.
	 *
	 * Minimum environment distance.
	 *
	 * This attribute records the minimum distance of the climatic area from the provided
	 * geometry.
	 */
	const kTAG_CLIM_DIST_MIN =   					'83';

	/**
	 * CLIM-DIST-MEAN.
	 *
	 * Mean environment distance.
	 *
	 * This attribute records the mean distance of the climatic area from the provided
	 * geometry.
	 */
	const kTAG_CLIM_DIST_MEAN =   					'84';

	/**
	 * CLIM-DIST-MAX.
	 *
	 * Maximum environment distance.
	 *
	 * This attribute records the maximum distance of the climatic area from the provided
	 * geometry.
	 */
	const kTAG_CLIM_DIST_MAX =   					'85';

	/*=======================================================================================
	 *	BIO-CLIMATIC ATTRIBUTES																*
	 *======================================================================================*/

	/**
	 * BIO1.
	 *
	 * Annual Mean Temperature.
	 */
	const kTAG_BIO1 =   							'86';

	/**
	 * BIO2.
	 *
	 * Mean Diurnal Range.
	 */
	const kTAG_BIO2 =   							'87';

	/**
	 * BIO3.
	 *
	 * Isothermality.
	 */
	const kTAG_BIO3 =   							'88';

	/**
	 * BIO4.
	 *
	 * Temperature Seasonality.
	 */
	const kTAG_BIO4 =   							'89';

	/**
	 * BIO5.
	 *
	 * Maximum Temperature of Warmest Month.
	 */
	const kTAG_BIO5 =   							'90';

	/**
	 * BIO6.
	 *
	 * Minimum Temperature of Coldest Month.
	 */
	const kTAG_BIO6 =   							'91';

	/**
	 * BIO7.
	 *
	 * Temperature Annual Range.
	 */
	const kTAG_BIO7 =   							'92';

	/**
	 * BIO8.
	 *
	 * Mean Temperature of Wettest Quarter.
	 */
	const kTAG_BIO8 =   							'93';

	/**
	 * BIO9.
	 *
	 * Mean Temperature of Driest Quarter.
	 */
	const kTAG_BIO9 =   							'94';

	/**
	 * BIO10.
	 *
	 * Mean Temperature of Warmest Quarter.
	 */
	const kTAG_BIO10 =   							'95';

	/**
	 * BIO11.
	 *
	 * Mean Temperature of Coldest Quarter.
	 */
	const kTAG_BIO11 =   							'96';

	/**
	 * BIO12.
	 *
	 * Annual Precipitation.
	 */
	const kTAG_BIO12 =   							'97';

	/**
	 * BIO13.
	 *
	 * Precipitation of Wettest Month.
	 */
	const kTAG_BIO13 =   							'98';

	/**
	 * BIO14.
	 *
	 * Precipitation of Driest Month.
	 */
	const kTAG_BIO14 =   							'99';

	/**
	 * BIO15.
	 *
	 * Precipitation Seasonality.
	 */
	const kTAG_BIO15 =   							'100';

	/**
	 * BIO16.
	 *
	 * Precipitation of Wettest Quarter.
	 */
	const kTAG_BIO16 =   							'101';

	/**
	 * BIO17.
	 *
	 * Precipitation of Driest Quarter.
	 */
	const kTAG_BIO17 =   							'102';

	/**
	 * BIO18.
	 *
	 * Precipitation of Warmest Quarter.
	 */
	const kTAG_BIO18 =   							'103';

	/**
	 * BIO19.
	 *
	 * Precipitation of Coldest Quarter.
	 */
	const kTAG_BIO19 =   							'104';

	/*=======================================================================================
	 *	MONTHLY TEMPERATURE ATTRIBUTES														*
	 *======================================================================================*/

	/**
	 * TEMP1.
	 *
	 * January mean temperature.
	 */
	const kTAG_TEMP1 =   							'105';

	/**
	 * TEMP1-MIN.
	 *
	 * January minimum temperature.
	 */
	const kTAG_TEMP1_MIN =   						'106';

	/**
	 * TEMP1-MAX.
	 *
	 * January maximum temperature.
	 */
	const kTAG_TEMP1_MAX =   						'107';

	/**
	 * TEMP2.
	 *
	 * February mean temperature.
	 */
	const kTAG_TEMP2 =   							'108';

	/**
	 * TEMP2-MIN.
	 *
	 * February minimum temperature.
	 */
	const kTAG_TEMP2_MIN =   						'109';

	/**
	 * TEMP2-MAX.
	 *
	 * February maximum temperature.
	 */
	const kTAG_TEMP2_MAX =   						'110';

	/**
	 * TEMP3.
	 *
	 * March mean temperature.
	 */
	const kTAG_TEMP3 =   							'111';

	/**
	 * TEMP3-MIN.
	 *
	 * March minimum temperature.
	 */
	const kTAG_TEMP3_MIN =   						'112';

	/**
	 * TEMP3-MAX.
	 *
	 * March maximum temperature.
	 */
	const kTAG_TEMP3_MAX =   						'113';

	/**
	 * TEMP4.
	 *
	 * April mean temperature.
	 */
	const kTAG_TEMP4 =   							'114';

	/**
	 * TEMP4-MIN.
	 *
	 * April minimum temperature.
	 */
	const kTAG_TEMP4_MIN =   						'115';

	/**
	 * TEMP4-MAX.
	 *
	 * April maximum temperature.
	 */
	const kTAG_TEMP4_MAX =   						'116';

	/**
	 * TEMP5.
	 *
	 * May mean temperature.
	 */
	const kTAG_TEMP5 =   							'117';

	/**
	 * TEMP5-MIN.
	 *
	 * May minimum temperature.
	 */
	const kTAG_TEMP5_MIN =   						'118';

	/**
	 * TEMP5-MAX.
	 *
	 * May maximum temperature.
	 */
	const kTAG_TEMP5_MAX =   						'119';

	/**
	 * TEMP6.
	 *
	 * June mean temperature.
	 */
	const kTAG_TEMP6 =   							'120';

	/**
	 * TEMP6-MIN.
	 *
	 * June minimum temperature.
	 */
	const kTAG_TEMP6_MIN =   						'121';

	/**
	 * TEMP6-MAX.
	 *
	 * June maximum temperature.
	 */
	const kTAG_TEMP6_MAX =   						'122';

	/**
	 * TEMP7.
	 *
	 * July mean temperature.
	 */
	const kTAG_TEMP7 =   							'123';

	/**
	 * TEMP7-MIN.
	 *
	 * July minimum temperature.
	 */
	const kTAG_TEMP7_MIN =   						'124';

	/**
	 * TEMP7-MAX.
	 *
	 * July maximum temperature.
	 */
	const kTAG_TEMP7_MAX =   						'125';

	/**
	 * TEMP8.
	 *
	 * August mean temperature.
	 */
	const kTAG_TEMP8 =   							'126';

	/**
	 * TEMP8-MIN.
	 *
	 * August minimum temperature.
	 */
	const kTAG_TEMP8_MIN =   						'127';

	/**
	 * TEMP8-MAX.
	 *
	 * August maximum temperature.
	 */
	const kTAG_TEMP8_MAX =   						'128';

	/**
	 * TEMP9.
	 *
	 * September mean temperature.
	 */
	const kTAG_TEMP9 =   							'129';

	/**
	 * TEMP9-MIN.
	 *
	 * September minimum temperature.
	 */
	const kTAG_TEMP9_MIN =   						'130';

	/**
	 * TEMP9-MAX.
	 *
	 * September maximum temperature.
	 */
	const kTAG_TEMP9_MAX =   						'131';

	/**
	 * TEMP10.
	 *
	 * October mean temperature.
	 */
	const kTAG_TEMP10 =   							'132';

	/**
	 * TEMP10-MIN.
	 *
	 * October minimum temperature.
	 */
	const kTAG_TEMP10_MIN =   						'133';

	/**
	 * TEMP10-MAX.
	 *
	 * October maximum temperature.
	 */
	const kTAG_TEMP10_MAX =   						'134';

	/**
	 * TEMP11.
	 *
	 * November mean temperature.
	 */
	const kTAG_TEMP11 =   							'135';

	/**
	 * TEMP11-MIN.
	 *
	 * November minimum temperature.
	 */
	const kTAG_TEMP11_MIN =   						'136';

	/**
	 * TEMP11-MAX.
	 *
	 * November maximum temperature.
	 */
	const kTAG_TEMP11_MAX =   						'137';

	/**
	 * TEMP12.
	 *
	 * December mean temperature.
	 */
	const kTAG_TEMP12 =   							'138';

	/**
	 * TEMP12-MIN.
	 *
	 * December minimum temperature.
	 */
	const kTAG_TEMP12_MIN =   						'139';

	/**
	 * TEMP12-MAX.
	 *
	 * December maximum temperature.
	 */
	const kTAG_TEMP12_MAX =   						'120';

	/*=======================================================================================
	 *	MONTHLY PRECIPITATION ATTRIBUTES													*
	 *======================================================================================*/

	/**
	 * PREC1.
	 *
	 * January mean precipitation (mm.).
	 */
	const kTAG_PREC1 =   							'141';

	/**
	 * PREC1-MIN.
	 *
	 * January minimum precipitation (mm.).
	 */
	const kTAG_PREC1_MIN =   						'142';

	/**
	 * PREC1-MAX.
	 *
	 * January maximum precipitation (mm.).
	 */
	const kTAG_PREC1_MAX =   						'143';

	/**
	 * PREC2.
	 *
	 * February mean precipitation (mm.).
	 */
	const kTAG_PREC2 =   							'144';

	/**
	 * PREC2-MIN.
	 *
	 * February minimum precipitation (mm.).
	 */
	const kTAG_PREC2_MIN =   						'145';

	/**
	 * PREC2-MAX.
	 *
	 * February maximum precipitation (mm.).
	 */
	const kTAG_PREC2_MAX =   						'146';

	/**
	 * PREC3.
	 *
	 * March mean precipitation (mm.).
	 */
	const kTAG_PREC3 =   							'147';

	/**
	 * PREC3-MIN.
	 *
	 * March minimum precipitation (mm.).
	 */
	const kTAG_PREC3_MIN =   						'148';

	/**
	 * PREC3-MAX.
	 *
	 * March maximum precipitation (mm.).
	 */
	const kTAG_PREC3_MAX =   						'149';

	/**
	 * PREC4.
	 *
	 * April mean precipitation (mm.).
	 */
	const kTAG_PREC4 =   							'150';

	/**
	 * PREC4-MIN.
	 *
	 * April minimum precipitation (mm.).
	 */
	const kTAG_PREC4_MIN =   						'151';

	/**
	 * PREC4-MAX.
	 *
	 * April maximum precipitation (mm.).
	 */
	const kTAG_PREC4_MAX =   						'152';

	/**
	 * PREC5.
	 *
	 * May mean precipitation (mm.).
	 */
	const kTAG_PREC5 =   							'153';

	/**
	 * PREC5-MIN.
	 *
	 * May minimum precipitation (mm.).
	 */
	const kTAG_PREC5_MIN =   						'154';

	/**
	 * PREC5-MAX.
	 *
	 * May maximum precipitation (mm.).
	 */
	const kTAG_PREC5_MAX =   						'155';

	/**
	 * PREC6.
	 *
	 * June mean precipitation (mm.).
	 */
	const kTAG_PREC6 =   							'156';

	/**
	 * PREC6-MIN.
	 *
	 * June minimum precipitation (mm.).
	 */
	const kTAG_PREC6_MIN =   						'157';

	/**
	 * PREC6-MAX.
	 *
	 * June maximum precipitation (mm.).
	 */
	const kTAG_PREC6_MAX =   						'158';

	/**
	 * PREC7.
	 *
	 * July mean precipitation (mm.).
	 */
	const kTAG_PREC7 =   							'159';

	/**
	 * PREC7-MIN.
	 *
	 * July minimum precipitation (mm.).
	 */
	const kTAG_PREC7_MIN =   						'160';

	/**
	 * PREC7-MAX.
	 *
	 * July maximum precipitation (mm.).
	 */
	const kTAG_PREC7_MAX =   						'161';

	/**
	 * PREC8.
	 *
	 * August mean precipitation (mm.).
	 */
	const kTAG_PREC8 =   							'162';

	/**
	 * PREC8-MIN.
	 *
	 * August minimum precipitation (mm.).
	 */
	const kTAG_PREC8_MIN =   						'163';

	/**
	 * PREC8-MAX.
	 *
	 * August maximum precipitation (mm.).
	 */
	const kTAG_PREC8_MAX =   						'164';

	/**
	 * PREC9.
	 *
	 * September mean precipitation (mm.).
	 */
	const kTAG_PREC9 =   							'165';

	/**
	 * PREC9-MIN.
	 *
	 * September minimum precipitation (mm.).
	 */
	const kTAG_PREC9_MIN =   						'166';

	/**
	 * PREC9-MAX.
	 *
	 * September maximum precipitation (mm.).
	 */
	const kTAG_PREC9_MAX =   						'167';

	/**
	 * PREC10.
	 *
	 * October mean precipitation (mm.).
	 */
	const kTAG_PREC10 =   							'168';

	/**
	 * PREC10-MIN.
	 *
	 * October minimum precipitation (mm.).
	 */
	const kTAG_PREC10_MIN =   						'169';

	/**
	 * PREC10-MAX.
	 *
	 * October maximum precipitation (mm.).
	 */
	const kTAG_PREC10_MAX =   						'170';

	/**
	 * PREC11.
	 *
	 * November mean precipitation (mm.).
	 */
	const kTAG_PREC11 =   							'171';

	/**
	 * PREC11-MIN.
	 *
	 * November minimum precipitation (mm.).
	 */
	const kTAG_PREC11_MIN =   						'172';

	/**
	 * PREC11-MAX.
	 *
	 * November maximum precipitation (mm.).
	 */
	const kTAG_PREC11_MAX =   						'173';

	/**
	 * PREC12.
	 *
	 * December mean precipitation (mm.).
	 */
	const kTAG_PREC12 =   							'174';

	/**
	 * PREC12-MIN.
	 *
	 * December minimum precipitation (mm.).
	 */
	const kTAG_PREC12_MIN =   						'175';

	/**
	 * PREC12-MAX.
	 *
	 * December maximum precipitation (mm.).
	 */
	const kTAG_PREC12_MAX =   						'176';

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
	const kTAG_FIRST_NAME =   						'177';

	/**
	 * LAST-NAME.
	 *
	 * Entity last name.
	 *
	 * The entity surname, in case of an individual.
	 */
	const kTAG_LAST_NAME =   						'178';

	/**
	 * MAIL.
	 *
	 * Entity mail.
	 *
	 * The mailing address of an entity.
	 */
	const kTAG_MAIL =   							'179';

	/**
	 * EMAIL.
	 *
	 * Entity e-mail.
	 *
	 * The e-mail address of an entity.
	 */
	const kTAG_EMAIL =   							'180';

	/**
	 * PHONE.
	 *
	 * Entity phone.
	 *
	 * The telephone number of an entity.
	 */
	const kTAG_PHONE =   							'181';

	/**
	 * FAX.
	 *
	 * Entity fax.
	 *
	 * The telefax number of an entity.
	 */
	const kTAG_FAX =   								'182';

	/**
	 * WEB-SITE.
	 *
	 * Entity web site.
	 *
	 * The entity internet web site address.
	 */
	const kTAG_WEB_SITE =   						'183';

	/**
	 * AFFILIATION.
	 *
	 * Entity affiliation.
	 *
	 * The reference to the entity with which the current entity is affiliated.
	 */
	const kTAG_AFFILIATION =   						'184';

	/**
	 * NATIONALITY.
	 *
	 * Nationality.
	 *
	 * The country of an entity.
	 */
	const kTAG_NATIONALITY =   						'185';

	/**
	 * ENTITY-KIND.
	 *
	 * Entity kind.
	 *
	 * The entity kind.
	 */
	const kTAG_ENTITY_KIND =   						'186';

	/**
	 * ENTITY-TYPE.
	 *
	 * Entity type.
	 *
	 * The entity type.
	 */
	const kTAG_ENTITY_TYPE =   						'187';

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
	const kTAG_USER_CODE =   						'188';

	/**
	 * USER-PASS.
	 *
	 * User password.
	 *
	 * The password by which a user is known to the system.
	 */
	const kTAG_USER_PASS =   						'189';

	/**
	 * USER-ROLE.
	 *
	 * User roles.
	 *
	 * The roles assigned to the user.
	 */
	const kTAG_USER_ROLE =   						'190';

	/**
	 * USER-PROFILE.
	 *
	 * User profile.
	 *
	 * The profile role name assigned to the user.
	 */
	const kTAG_USER_PROFILE =   					'191';

	/**
	 * USER-DOMAIN.
	 *
	 * User domain.
	 *
	 * List of domains the user has access to.
	 */
	const kTAG_USER_DOMAIN =   						'192';

	/**
	 * USER-SOCIAL-NETWORK.
	 *
	 * User social network.
	 */
	const kTAG_USER_SOCIAL_NETWORK =   				'193';

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

	/**
	 * coordinates.
	 *
	 * Custom data object coordinates.
	 *
	 * This tag is used as the default offset for indicating the coordinate values of a shape.
	 *
	 * Version 1: (kTAG_CUSTOM_COORDINATES)[coordinates]
	 */
	const kTAG_CUSTOM_COORDINATES =   				'coordinates';

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
