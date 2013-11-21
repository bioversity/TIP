/*=======================================================================================
 *																						*
 *									Tags.inc.js											*
 *																						*
 *======================================================================================*/

/**
 * Default attribute tags.
 *
 * This file contains the tag definitions for all default attributes, these tags are used
 * as the object's attribute keys and are related to the default attribute terms.
 *
 * To convert this file to javascript use the following grep pattern:
 * <code>
 * search:  ^define\( "(.+)",.+(\'.+\').*;
 * replace: var \1 = \2;
 * </code>
 *
 * To convert the definitions into constants:
 * <code>
 * search:  ^\tdefine\( \"(.+)\"\,(.+)(\'.+\') \);\r
 * replace: \tconst \1 =   \2\3;\r
 * </code>
 *
 *	@package	MyWrapper
 *	@subpackage	Definitions
 *
 *	@author		Milko A. Škofič <m.skofic@cgiar.org>
 *	@version	1.00 19/11/2013
 */

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
var kTAG_NID = '_id';

/**
 * NAMESPACE.
 *
 * Namespace.
 *
 * This attribute is a reference to a term which represents the namespace of the current
 * object. The object local identifiers must be unique within the scope of the namespace.
 */
var kTAG_NAMESPACE = '1';

/**
 * LID.
 *
 * Local identifier.
 *
 * This attribute contains the local unique identifier. This value represents the value that
 * uniquely identifies an object within a specific domain or namespace. It is by definition
 * a string constituting the suffix of the global identifier, {@link kTAG_GID}.
 */
var kTAG_LID = '2';

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
var kTAG_GID = '3';

/**
 * UID.
 *
 * Unique identifier.
 *
 * This attribute contains the hashed unique identifier of an object in which its
 * {@link kTAG_NID} is not related to the {@link kTAG_GID}. This is generally used when
 * the {@link kTAG_NID} is a sequence number.
 */
var kTAG_UID = '4';

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
var kTAG_PID = '5';

/**
 * CURRENT.
 *
 * Current identifier.
 *
 * This attribute is used when the current object is obsolete or superseeded, it holds a
 * reference to the object that replaces the current one.
 */
var kTAG_CURRENT = '6';

/**
 * SYNONYMS.
 *
 * Synonyms.
 *
 * This attribute contains a list of strings that represent alternate identifiers for the
 * hosting object. Synonyms do not have any relation to the namespace.
 */
var kTAG_SYNONYMS = '7';

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
var kTAG_DOMAIN = '8';

/**
 * AUTHORITY.
 *
 * Authority.
 *
 * This attribute is an enumerated set that contains the authority to which the hosting
 * object belongs to.
 */
var kTAG_AUTHORITY = '9';

/**
 * COLLECTION.
 *
 * Collection.
 *
 * This string attribute represents the collection identifier, it acts as a namespace for
 * identifiers and as a collection for objects.
 */
var kTAG_COLLECTION = '10';

/**
 * CATEGORY.
 *
 * Category.
 *
 * This attribute is an enumerated set that contains all the categories to which the hosting
 * object belongs to.
 */
var kTAG_CATEGORY = '11';

/**
 * KIND.
 *
 * Kind.
 *
 * This attribute is an enumerated set that defines the kind of the hosting object.
 */
var kTAG_KIND = '12';

/**
 * TYPE.
 *
 * Type.
 *
 * This attribute is an enumerated set that contains a combination of data type and
 * cardinality indicators which, combined, represet the data type of the hosting object.
 */
var kTAG_TYPE = '13';

/**
 * INDEX.
 *
 * Index.
 *
 * This attribute is an integer that represets the relative position of the object within
 * its container.
 */
var kTAG_INDEX = '14';

/**
 * RANK.
 *
 * Rank.
 *
 * This attribute defines the rank of the object.
 */
var kTAG_RANK = '15';

/**
 * CLASS.
 *
 * Class.
 *
 * This attribute is a string that represets the referenced object's class. This attribute
 * is used to instantiate the correct class once an object has been retrieved from its
 * container.
 */
var kTAG_CLASS = '16';

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
var kTAG_INPUT = '17';

/**
 * PATTERN.
 *
 * Pattern.
 *
 * This attribute represents the regular expression pattern that can be used to validate the
 * value of the referenced property.
 */
var kTAG_PATTERN = '18';

/**
 * LENGTH.
 *
 * Length.
 *
 * This attribute represents the maximum number of characters that may comprise the value of
 * the referenced property.
 */
var kTAG_LENGTH = '19';

/**
 * MIN.
 *
 * Minimum value.
 *
 * This attribute represents the minimum value that the referenced property may hold.
 */
var kTAG_MIN_VAL = '20';

/**
 * MAX.
 *
 * Maximum value.
 *
 * This attribute represents the maximum value that the referenced property may hold.
 */
var kTAG_MAX_VAL = '21';

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
var kTAG_NAME = '22';

/**
 * LABEL.
 *
 * Label.
 *
 * This attribute represents the label, name or short description of the referenced object.
 * It is a {@link kTYPE_LSTRING} structure in which the label can be expressed in several
 * languages.
 */
var kTAG_LABEL = '23';

/**
 * DEFINITION.
 *
 * Definition.
 *
 * This attribute represents the definition of the referenced object. It is an
 * {@link kTYPE_LSTRING} structure in which the definition can be expressed in several
 + languages. A definition is independent of the context.
 */
var kTAG_DEFINITION = '24';

/**
 * DESCRIPTION.
 *
 * Description.
 *
 * This attribute represents the description of the referenced object. It is an
 * {@link kTYPE_LSTRING} structure in which the description can be expressed in several
 * languages. A description depends on the context.
 */
var kTAG_DESCRIPTION = '25';

/**
 * NOTES.
 *
 * Notes.
 *
 * This attribute represents the notes or comments of the referenced object.
 * It is a {@link kTYPE_LSTRING} structure in which the description can be expressed in
 * several languages.
 */
var kTAG_NOTES = '26';

/**
 * EXAMPLES.
 *
 * Examples.
 *
 * This attribute represents the examples or templates of the referenced object.
 * It is a list of strings where each string represents an example or template.
 */
var kTAG_EXAMPLES = '27';

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
var kTAG_AUTHORS = '28';

/**
 * ACKNOWLEDGMENTS.
 *
 * Acknowledgments.
 *
 * This attribute represents a list of generic acknowledgments, it is an array of strings.
 */
var kTAG_ACKNOWLEDGMENTS = '29';

/**
 * BIBLIOGRAPHY.
 *
 * Bibliography.
 *
 * This attribute represents a list of bibliographic references, it is an array of strings.
 */
var kTAG_BIBLIOGRAPHY = '30';

/**
 * VERSION.
 *
 * Version.
 *
 * This attribute represents the object's version.
 */
var kTAG_VERSION = '31';

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
var kTAG_UNIT = '32';

/**
 * ENTITY.
 *
 * Entity.
 *
 * This attribute contains a reference to an entity object.
 */
var kTAG_ENTITY = '33';

/**
 * TERM.
 *
 * Term.
 *
 * This attribute contains a reference to an object that represents the term of the
 * attribute host.
 */
var kTAG_TERM = '34';

/**
 * NODE.
 *
 * Node.
 *
 * This attribute contains a reference to an object that represents the master node of the
 * attribute host.
 */
var kTAG_NODE = '35';

/**
 * TAG.
 *
 * Tag.
 *
 * This attribute contains a reference to an object that represents a tag.
 */
var kTAG_TAG = '36';

/**
 * SUBJECT.
 *
 * Subject.
 *
 * This attribute contains a reference to an object that represents the start, origin or
 * subject vertex of a <tt>subject</tt>/<tt>predicate</tt>/<tt>object</tt> relationship.
 */
var kTAG_SUBJECT = '37';

/**
 * kTAG_OBJECT.
 *
 * Object.
 *
 * This attribute contains a reference to an object that represents the end, destination or
 * object vertex of a <tt>subject</tt>/<tt>predicate</tt>/<tt>object</tt> relationship.
 */
var kTAG_OBJECT = '38';

/**
 * PREDICATE.
 *
 * Predicate.
 *
 * This attribute contains a reference to an object that represents the predicate term of a
 * <tt>subject</tt>/<tt>predicate</tt>/<tt>object</tt> relationship.
 */
var kTAG_PREDICATE = '39';

/**
 * PATH.
 *
 * Path.
 *
 * This attribute represents a sequence of <tt>vertex</tt>, <tt>predicate</tt>,
 * <tt>vertex</tt> elements whose concatenation represents a path between an origin vertex
 * and a destination vertex.
 */
var kTAG_PATH = '40';

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
var kTAG_NAMESPACE_REFS = '41';

/**
 * DATAPOINT-REFS.
 *
 * Data point references count.
 *
 * This integer attribute counts how many times the current tag was used to annotate data.
 */
var kTAG_DATAPOINT_REFS = '42';

/**
 * NODES.
 *
 * Nodes.
 *
 * This attribute is a collection of node references, it is an array of node object native
 * identifiers who reference the current object.
 */
var kTAG_NODES = '43';

/**
 * EDGES.
 *
 * Edges.
 *
 * This attribute is a collection of edge references, it is an array of edge object native
 * identifiers who reference the current object.
 */
var kTAG_EDGES = '44';

/**
 * TAGS.
 *
 * Tags.
 *
 * This attribute is a collection of tag references, it is an array of tag object native
 * identifiers referenced by the current object.
 */
var kTAG_TAGS = '45';

/**
 * OFFSETS.
 *
 * Offsets.
 *
 * This attribute is a collection of offsets, that is, an array of strings representing a
 * set of offsets.
 */
var kTAG_OFFSETS = '46';

/**
 * FEATURES.
 *
 * Features.
 *
 * This attribute is a collection of feature references, it is an array of object native
 * identifiers that reference the current object as a feature or trait.
 */
var kTAG_FEATURES = '47';

/**
 * METHODS.
 *
 * Methods.
 *
 * This attribute is a collection of method references, it is an array of object native
 * identifiers that reference the current object as a method or modifier.
 */
var kTAG_METHODS = '48';

/**
 * SCALES.
 *
 * Scales.
 *
 * This attribute is a collection of scale references, it is an array of object native
 * identifiers that reference the current object as a scale or unit.
 */
var kTAG_SCALES = '49';

/**
 * MERGED.
 *
 * Merged.
 *
 * This attribute is a collection of tag references, it is used by tags common to several
 * object domains, the value of the tags in this list is automatically set into the current
 * tag.
 */
var kTAG_MERGED = '50';

/*=======================================================================================
 *	OBJECT CATEGORIES																	*
 *======================================================================================*/

/**
 * INVENTORY.
 *
 * Inventory attributes.
 */
var kTAG_INVENTORY = '51';

/**
 * STATUS.
 *
 * Status attributes.
 */
var kTAG_STATUS = '52';

/**
 * EVENT.
 *
 * Event.
 */
var kTAG_EVENT = '53';

/**
 * OCCURRENCE.
 *
 * Occurrence.
 */
var kTAG_OCCURRENCE = '54';

/**
 * TAXON.
 *
 * Taxon attributes.
 */
var kTAG_TAXON = '55';

/**
 * LOCATION.
 *
 * Location attributes.
 */
var kTAG_LOCATION = '56';

/**
 * ENVIRONMENT.
 *
 * Environment attributes.
 */
var kTAG_ENVIRONMENT = '57';

/**
 * BIOCLIMATIC.
 *
 * Bio-climatic attributes.
 */
var kTAG_BIOCLIMATIC = '58';

/**
 * TEMPERATURE.
 *
 * Monthly temperature attributes.
 */
var kTAG_TEMPERATURE = '59';

/**
 * PRECIPITATION.
 *
 * Monthly precipitation attributes.
 */
var kTAG_PRECIPITATION = '60';

/*=======================================================================================
 *	INVENTORY ATTRIBUTES																*
 *======================================================================================*/

/**
 * NICODE.
 *
 * National inventory.
 */
var kTAG_NICODE = '61';

/**
 * FAO:INSTCODE.
 *
 * Responsible institution.
 */
var kTAG_INSTCODE = '62';

/*=======================================================================================
 *	STATUS ATTRIBUTES																	*
 *======================================================================================*/

/**
 * AVAILABLE.
 *
 * Available.
 */
var kTAG_AVAILABLE = '63';

/*=======================================================================================
 *	TAXON ATTRIBUTES																	*
 *======================================================================================*/

/**
 * TAXON-NAME.
 *
 * Taxon name.
 */
var kTAG_TAXON_NAME = '64';

/**
 * TAXON-RANK.
 *
 * Taxon rank.
 */
var kTAG_TAXON_RANK = '65';

/**
 * CROP.
 *
 * Taxon crop.
 */
var kTAG_CROP = '66';

/**
 * ANNEX1.
 *
 * Taxon name.
 */
var kTAG_ANNEX1 = '67';

/*=======================================================================================
 *	LOCATION ATTRIBUTES																	*
 *======================================================================================*/

/**
 * COORDINATES.
 *
 * Location coordinates.
 */
var kTAG_COORDINATES = '68';

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
var kTAG_LATITUDE_DISPLAY = '69';

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
var kTAG_LONGITUDE_DISPLAY = '70';

/*=======================================================================================
 *	ENVIRONMENT ATTRIBUTES																*
 *======================================================================================*/

/**
 * GENS.
 *
 * Global Environment Stratification.
 */
var kTAG_GENS = '71';

/**
 * GENS-CLIM.
 *
 * Climatic Zone.
 */
var kTAG_GENS_CLIM = '72';

/**
 * GENS-ENV.
 *
 * Environmental Zone.
 */
var kTAG_GENS_ENV = '73';

/**
 * CLIM-MIN.
 *
 * Minimum environment elevation.
 *
 * This attribute records the minimum elevation of the climatic area, that is, the minimum
 * elevation found when retrieving climatic data.
 */
var kTAG_CLIM_ELEV_MIN = '74';

/**
 * CLIM-MAX.
 *
 * Maximum environment elevation.
 *
 * This attribute records the maximum elevation of the climatic area, that is, the maximum
 * elevation found when retrieving climatic data.
 */
var kTAG_CLIM_ELEV_MAX = '75';

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
var kTAG_BIO1 = '76';

/**
 * BIO2.
 *
 * Mean Diurnal Range.
 *
 * Mean diurnal range: mean of monthly (max temp - min temp) (C° × 10).
 */
var kTAG_BIO2 = '77';

/**
 * BIO3.
 *
 * Isothermality.
 *
 * Isothermality ((Mean Diurnal Range / Temperature Annual Range) × 100).
 */
var kTAG_BIO3 = '78';

/**
 * BIO4.
 *
 * Temperature Seasonality.
 *
 * Temperature seasonality (standard deviation × 100).
 */
var kTAG_BIO4 = '79';

/**
 * BIO5.
 *
 * Maximum Temperature of Warmest Month.
 *
 * Maximum temperature of warmest month (C° × 10).
 */
var kTAG_BIO5 = '80';

/**
 * BIO6.
 *
 * Minimum Temperature of Coldest Month.
 *
 * Minimum temperature of coldest month (C° × 10).
 */
var kTAG_BIO6 = '81';

/**
 * BIO7.
 *
 * Temperature Annual Range.
 *
 * Temperature annual range (Maximum Temperature of Warmest Month - Minimum Temperature of
 * Coldest Month).
 */
var kTAG_BIO7 = '82';

/**
 * BIO8.
 *
 * Mean Temperature of Wettest Quarter.
 *
 * Mean temperature of wettest quarter (C° × 10).
 */
var kTAG_BIO8 = '83';

/**
 * BIO9.
 *
 * Mean Temperature of Driest Quarter.
 *
 * Mean temperature of driest quarter (C° × 10).
 */
var kTAG_BIO9 = '84';

/**
 * BIO10.
 *
 * Mean Temperature of Warmest Quarter.
 *
 * Mean temperature of warmest quarter (C° × 10).
 */
var kTAG_BIO10 = '85';

/**
 * BIO11.
 *
 * Mean Temperature of Coldest Quarter.
 *
 * Mean temperature of coldest quarter (C° × 10).
 */
var kTAG_BIO11 = '86';

/**
 * BIO12.
 *
 * Annual Precipitation.
 */
var kTAG_BIO12 = '87';

/**
 * BIO13.
 *
 * Precipitation of Wettest Month.
 */
var kTAG_BIO13 = '88';

/**
 * BIO14.
 *
 * Precipitation of Driest Month.
 */
var kTAG_BIO14 = '89';

/**
 * BIO15.
 *
 * Precipitation Seasonality.
 *
 * Precipitation seasonality (Coefficient of Variation).
 */
var kTAG_BIO15 = '90';

/**
 * BIO16.
 *
 * Precipitation of Wettest Quarter.
 */
var kTAG_BIO16 = '91';

/**
 * BIO17.
 *
 * Precipitation of Driest Quarter.
 */
var kTAG_BIO17 = '92';

/**
 * BIO18.
 *
 * Precipitation of Warmest Quarter.
 */
var kTAG_BIO18 = '93';

/**
 * BIO19.
 *
 * Precipitation of Coldest Quarter.
 */
var kTAG_BIO19 = '94';

/*=======================================================================================
 *	MONTHLY TEMPERATURE ATTRIBUTES														*
 *======================================================================================*/

/**
 * TEMP1.
 *
 * January mean temperature.
 *
 * January mean temperature (C° × 10).
 */
var kTAG_TEMP1 = '95';

/**
 * TEMP1-MIN.
 *
 * January minimum temperature.
 *
 * January minimum temperature (C° × 10).
 */
var kTAG_TEMP1_MIN = '96';

/**
 * TEMP1-MAX.
 *
 * January maximum temperature.
 *
 * January maximum temperature (C° × 10).
 */
var kTAG_TEMP1_MAX = '97';

/**
 * TEMP2.
 *
 * February mean temperature.
 *
 * February mean temperature (C° × 10).
 */
var kTAG_TEMP2 = '98';

/**
 * TEMP2-MIN.
 *
 * February minimum temperature.
 *
 * February minimum temperature (C° × 10).
 */
var kTAG_TEMP2_MIN = '99';

/**
 * TEMP2-MAX.
 *
 * February maximum temperature.
 *
 * February maximum temperature (C° × 10).
 */
var kTAG_TEMP2_MAX = '100';

/**
 * TEMP3.
 *
 * March mean temperature.
 *
 * March mean temperature (C° × 10).
 */
var kTAG_TEMP3 = '101';

/**
 * TEMP3-MIN.
 *
 * March minimum temperature.
 *
 * March minimum temperature (C° × 10).
 */
var kTAG_TEMP3_MIN = '102';

/**
 * TEMP3-MAX.
 *
 * March maximum temperature.
 *
 * March maximum temperature (C° × 10).
 */
var kTAG_TEMP3_MAX = '103';

/**
 * TEMP4.
 *
 * April mean temperature.
 *
 * April mean temperature (C° × 10).
 */
var kTAG_TEMP4 = '104';

/**
 * TEMP4-MIN.
 *
 * April minimum temperature.
 *
 * April minimum temperature (C° × 10).
 */
var kTAG_TEMP4_MIN = '105';

/**
 * TEMP4-MAX.
 *
 * April maximum temperature.
 *
 * April maximum temperature (C° × 10).
 */
var kTAG_TEMP4_MAX = '106';

/**
 * TEMP5.
 *
 * May mean temperature.
 *
 * May mean temperature (C° × 10).
 */
var kTAG_TEMP5 = '107';

/**
 * TEMP5-MIN.
 *
 * May minimum temperature.
 *
 * May minimum temperature (C° × 10).
 */
var kTAG_TEMP5_MIN = '108';

/**
 * TEMP5-MAX.
 *
 * May maximum temperature.
 *
 * May maximum temperature (C° × 10).
 */
var kTAG_TEMP5_MAX = '109';

/**
 * TEMP6.
 *
 * June mean temperature.
 *
 * June mean temperature (C° × 10).
 */
var kTAG_TEMP6 = '110';

/**
 * TEMP6-MIN.
 *
 * June minimum temperature.
 *
 * June minimum temperature (C° × 10).
 */
var kTAG_TEMP6_MIN = '111';

/**
 * TEMP6-MAX.
 *
 * June maximum temperature.
 *
 * June maximum temperature (C° × 10).
 */
var kTAG_TEMP6_MAX = '112';

/**
 * TEMP7.
 *
 * July mean temperature.
 *
 * July mean temperature (C° × 10).
 */
var kTAG_TEMP7 = '113';

/**
 * TEMP7-MIN.
 *
 * July minimum temperature.
 *
 * July minimum temperature (C° × 10).
 */
var kTAG_TEMP7_MIN = '114';

/**
 * TEMP7-MAX.
 *
 * July maximum temperature.
 *
 * July maximum temperature (C° × 10).
 */
var kTAG_TEMP7_MAX = '115';

/**
 * TEMP8.
 *
 * August mean temperature.
 *
 * August mean temperature (C° × 10).
 */
var kTAG_TEMP8 = '116';

/**
 * TEMP8-MIN.
 *
 * August minimum temperature.
 *
 * August minimum temperature (C° × 10).
 */
var kTAG_TEMP8_MIN = '117';

/**
 * TEMP8-MAX.
 *
 * August maximum temperature.
 *
 * August maximum temperature (C° × 10).
 */
var kTAG_TEMP8_MAX = '118';

/**
 * TEMP9.
 *
 * September mean temperature.
 *
 * September mean temperature (C° × 10).
 */
var kTAG_TEMP9 = '119';

/**
 * TEMP9-MIN.
 *
 * September minimum temperature.
 *
 * September minimum temperature (C° × 10).
 */
var kTAG_TEMP9_MIN = '120';

/**
 * TEMP9-MAX.
 *
 * September maximum temperature.
 *
 * September maximum temperature (C° × 10).
 */
var kTAG_TEMP9_MAX = '121';

/**
 * TEMP10.
 *
 * October mean temperature.
 *
 * October mean temperature (C° × 10).
 */
var kTAG_TEMP10 = '122';

/**
 * TEMP10-MIN.
 *
 * October minimum temperature.
 *
 * October minimum temperature (C° × 10).
 */
var kTAG_TEMP10_MIN = '123';

/**
 * TEMP10-MAX.
 *
 * October maximum temperature.
 *
 * October maximum temperature (C° × 10).
 */
var kTAG_TEMP10_MAX = '124';

/**
 * TEMP11.
 *
 * November mean temperature.
 *
 * November mean temperature (C° × 10).
 */
var kTAG_TEMP11 = '125';

/**
 * TEMP11-MIN.
 *
 * November minimum temperature.
 *
 * November minimum temperature (C° × 10).
 */
var kTAG_TEMP11_MIN = '126';

/**
 * TEMP11-MAX.
 *
 * November maximum temperature.
 *
 * November maximum temperature (C° × 10).
 */
var kTAG_TEMP11_MAX = '127';

/**
 * TEMP12.
 *
 * December mean temperature.
 *
 * December mean temperature (C° × 10).
 */
var kTAG_TEMP12 = '128';

/**
 * TEMP12-MIN.
 *
 * December minimum temperature.
 *
 * December minimum temperature (C° × 10).
 */
var kTAG_TEMP12_MIN = '129';

/**
 * TEMP12-MAX.
 *
 * December maximum temperature.
 *
 * December maximum temperature (C° × 10).
 */
var kTAG_TEMP12_MAX = '130';

/*=======================================================================================
 *	MONTHLY PRECIPITATION ATTRIBUTES													*
 *======================================================================================*/

/**
 * PREC1.
 *
 * January mean precipitation (mm.).
 */
var kTAG_PREC1 = '131';

/**
 * PREC1-MIN.
 *
 * January minimum precipitation (mm.).
 */
var kTAG_PREC1_MIN = '132';

/**
 * PREC1-MAX.
 *
 * January maximum precipitation (mm.).
 */
var kTAG_PREC1_MAX = '133';

/**
 * PREC2.
 *
 * February mean precipitation (mm.).
 */
var kTAG_PREC2 = '134';

/**
 * PREC2-MIN.
 *
 * February minimum precipitation (mm.).
 */
var kTAG_PREC2_MIN = '135';

/**
 * PREC2-MAX.
 *
 * February maximum precipitation (mm.).
 */
var kTAG_PREC2_MAX = '136';

/**
 * PREC3.
 *
 * March mean precipitation (mm.).
 */
var kTAG_PREC3 = '137';

/**
 * PREC3-MIN.
 *
 * March minimum precipitation (mm.).
 */
var kTAG_PREC3_MIN = '138';

/**
 * PREC3-MAX.
 *
 * March maximum precipitation (mm.).
 */
var kTAG_PREC3_MAX = '139';

/**
 * PREC4.
 *
 * April mean precipitation (mm.).
 */
var kTAG_PREC4 = '140';

/**
 * PREC4-MIN.
 *
 * April minimum precipitation (mm.).
 */
var kTAG_PREC4_MIN = '141';

/**
 * PREC4-MAX.
 *
 * April maximum precipitation (mm.).
 */
var kTAG_PREC4_MAX = '142';

/**
 * PREC5.
 *
 * May mean precipitation (mm.).
 */
var kTAG_PREC5 = '143';

/**
 * PREC5-MIN.
 *
 * May minimum precipitation (mm.).
 */
var kTAG_PREC5_MIN = '144';

/**
 * PREC5-MAX.
 *
 * May maximum precipitation (mm.).
 */
var kTAG_PREC5_MAX = '145';

/**
 * PREC6.
 *
 * June mean precipitation (mm.).
 */
var kTAG_PREC6 = '146';

/**
 * PREC6-MIN.
 *
 * June minimum precipitation (mm.).
 */
var kTAG_PREC6_MIN = '147';

/**
 * PREC6-MAX.
 *
 * June maximum precipitation (mm.).
 */
var kTAG_PREC6_MAX = '148';

/**
 * PREC7.
 *
 * July mean precipitation (mm.).
 */
var kTAG_PREC7 = '149';

/**
 * PREC7-MIN.
 *
 * July minimum precipitation (mm.).
 */
var kTAG_PREC7_MIN = '150';

/**
 * PREC7-MAX.
 *
 * July maximum precipitation (mm.).
 */
var kTAG_PREC7_MAX = '151';

/**
 * PREC8.
 *
 * August mean precipitation (mm.).
 */
var kTAG_PREC8 = '152';

/**
 * PREC8-MIN.
 *
 * August minimum precipitation (mm.).
 */
var kTAG_PREC8_MIN = '153';

/**
 * PREC8-MAX.
 *
 * August maximum precipitation (mm.).
 */
var kTAG_PREC8_MAX = '154';

/**
 * PREC9.
 *
 * September mean precipitation (mm.).
 */
var kTAG_PREC9 = '155';

/**
 * PREC9-MIN.
 *
 * September minimum precipitation (mm.).
 */
var kTAG_PREC9_MIN = '156';

/**
 * PREC9-MAX.
 *
 * September maximum precipitation (mm.).
 */
var kTAG_PREC9_MAX = '157';

/**
 * PREC10.
 *
 * October mean precipitation (mm.).
 */
var kTAG_PREC10 = '158';

/**
 * PREC10-MIN.
 *
 * October minimum precipitation (mm.).
 */
var kTAG_PREC10_MIN = '159';

/**
 * PREC10-MAX.
 *
 * October maximum precipitation (mm.).
 */
var kTAG_PREC10_MAX = '160';

/**
 * PREC11.
 *
 * November mean precipitation (mm.).
 */
var kTAG_PREC11 = '161';

/**
 * PREC11-MIN.
 *
 * November minimum precipitation (mm.).
 */
var kTAG_PREC11_MIN = '162';

/**
 * PREC11-MAX.
 *
 * November maximum precipitation (mm.).
 */
var kTAG_PREC11_MAX = '163';

/**
 * PREC12.
 *
 * December mean precipitation (mm.).
 */
var kTAG_PREC12 = '164';

/**
 * PREC12-MIN.
 *
 * December minimum precipitation (mm.).
 */
var kTAG_PREC12_MIN = '165';

/**
 * PREC12-MAX.
 *
 * December maximum precipitation (mm.).
 */
var kTAG_PREC12_MAX = '166';

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
var kTAG_FIRST_NAME = '167';

/**
 * LAST-NAME.
 *
 * Entity last name.
 *
 * The entity surname, in case of an individual.
 */
var kTAG_LAST_NAME = '168';

/**
 * MAIL.
 *
 * Entity mail.
 *
 * The mailing address of an entity.
 */
var kTAG_MAIL = '169';

/**
 * EMAIL.
 *
 * Entity e-mail.
 *
 * The e-mail address of an entity.
 */
var kTAG_EMAIL = '170';

/**
 * PHONE.
 *
 * Entity phone.
 *
 * The telephone number of an entity.
 */
var kTAG_PHONE = '171';

/**
 * FAX.
 *
 * Entity fax.
 *
 * The telefax number of an entity.
 */
var kTAG_FAX = '172';

/**
 * WEB-SITE.
 *
 * Entity web site.
 *
 * The entity internet web site address.
 */
var kTAG_WEB_SITE = '173';

/**
 * AFFILIATION.
 *
 * Entity affiliation.
 *
 * The reference to the entity with which the current entity is affiliated.
 */
var kTAG_AFFILIATION = '174';

/**
 * NATIONALITY.
 *
 * Nationality.
 *
 * The country of an entity.
 */
var kTAG_NATIONALITY = '175';

/**
 * ENTITY-KIND.
 *
 * Entity kind.
 *
 * The entity kind.
 */
var kTAG_ENTITY_KIND = '176';

/**
 * ENTITY-TYPE.
 *
 * Entity type.
 *
 * The entity type.
 */
var kTAG_ENTITY_TYPE = '177';

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
var kTAG_USER_CODE = '178';

/**
 * USER-PASS.
 *
 * User password.
 *
 * The password by which a user is known to the system.
 */
var kTAG_USER_PASS = '179';

/**
 * USER-ROLE.
 *
 * User roles.
 *
 * The roles assigned to the user.
 */
var kTAG_USER_ROLE = '180';

/**
 * USER-PROFILE.
 *
 * User profile.
 *
 * The profile role name assigned to the user.
 */
var kTAG_USER_PROFILE = '181';

/**
 * USER-DOMAIN.
 *
 * User domain.
 *
 * List of domains the user has access to.
 */
var kTAG_USER_DOMAIN = '182';

/**
 * USER-SOCIAL-NETWORK.
 *
 * User social network.
 */
var kTAG_USER_SOCIAL_NETWORK = '183';

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
var kTAG_CUSTOM_TYPE = 'type';

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
var kTAG_CUSTOM_DATA = 'data';

/**
 * coordinates.
 *
 * Custom data object coordinates.
 *
 * This tag is used as the default offset for indicating the coordinate values of a shape.
 *
 * Version 1: (kTAG_CUSTOM_COORDINATES)[coordinates]
 */
var kTAG_CUSTOM_COORDINATES = 'coordinates';

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
var kTAG_STAMP_SEC = 'sec';

/**
 * usec.
 *
 * Microseconds.
 *
 * This tag defines microseconds.
 *
 * Version 1: (kTYPE_STAMP_USEC)[usec]
 */
var kTAG_STAMP_USEC = 'usec';

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
var kTAG_TYPED_TYPE = 'tp';

/**
 * d.
 *
 * Data.
 *
 * This tag defines the typed list element data offset.
 *
 * Version 1: (kTAG_TYPED_DATA)[dt]
 */
var kTAG_TYPED_DATA = 'dt';

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
var kTAG_RANGE_MIN = 'l';

/**
 * m.
 *
 * Mean.
 *
 * This tag defines the mean value offset.
 *
 * Version 1: (kTAG_RANGE_MEAN)[m]
 */
var kTAG_RANGE_MEAN = 'm';

/**
 * h.
 *
 * Maximum.
 *
 * This tag defines the maximum value offset.
 *
 * Version 1: (kTAG_RANGE_MAX)[h]
 */
var kTAG_RANGE_MAX = 'h';


$(document).ready(function(){
    autocomplateForm();
    bindButtons();
    bindTrialButton();
    //bindTrialDetail();
    //loadMap('39.1667', '30.89136');
});

function bindTrialDetail() {
    $(document).on("click", ".trial_detail", function(){
        var jsonString = JSON.stringify($(this).attr('value'));
        var trials= 'no trails founds';
        
        $('#TrialModal #loader').fadeIn('slow');
        $('#TrialModal div#embedded_content_trial_detail').html('');
        
        $.ajax({
            type: "POST",
            url: dev_stage+'/modal-trial-detail',
            data: {unit : jsonString},
            dataType: "html",
            success: function( data ) {
                $('#TrialModal #loader').fadeOut();
                $('#TrialModal div#embedded_content_trial_detail').html(data);
                $('#TrialModal div#embedded_content_trial_detail').fadeIn('slow');
            }
        });
    });
}

function bindTrialButton()
{
    $(document).on("click", ".show_trial", function(){
        var jsonString = JSON.stringify($(this).attr('value'));
        var trials= 'no trails founds';
        
        $('#TrialModal .modal-body div#embedded_content_trial_list').html('');
        $('#TrialModal .modal-body div#embedded_content_trial_detail').html('');
        $('#TrialModal #loader').fadeIn('slow');
        
        $.ajax({
            type: "POST",
            url: dev_stage+'/modal-trial',
            data: {unit : jsonString},
            dataType: "html",
            success: function( data ) {
                $('#TrialModal #loader').fadeOut();
                $('#TrialModal .modal-body div#embedded_content_trial_list').html(data);
                $('#TrialModal .modal-body div#embedded_content_trial_list').fadeIn('slow');
            }
        });
    });    
}

function setPage(url)
{
    sendLink(url);
    //$('#form_fields_page').val(page);
    //$('#form_fields').submit();
}

//function setPage(page)
//{
//    $('#form_fields_page').val(page);
//    $('#form_fields').submit();
//}

function bindButtons()
{
    $('#searchTrait').submit(function(event){
        event.preventDefault();
        getFieldsForm($("#TraitSearch_trait").val());
    });
    
    
    $('#form_fields').submit(function(event){
        event.preventDefault();
        
        $('#summary').html('');
        $('#units_list').html('');
        $('#form_fields_search').addClass('working');
        disableButton('form_fields_search');
        $.ajax({
            type:       "POST",
            url:        dev_stage+'/trait/json/find/summary/trait',
            dataType:   "html",
            data:       $(this).serializeArray(),
            success: function( data ) {
                $('#form_fields_search').removeClass('working');
                enableButton('form_fields_search');
                $('#summary').append(data);
            }
        }).fail(function(){
            $('#form_fields_search').removeClass('working');
            enableButton('form_fields_search');
        });
    });    
    
    $(document).on("click", "#summary a", function(event){
        event.preventDefault();
        
        $(this).find('.distinct_value').addClass('working');
        sendLink($(this).attr('href'));
    });
    
    $(document).on("click", "#prev_page", function(event){
        event.preventDefault();
        
        sendLink($('#prev_page_value').val());
    });
    
    $(document).on("click", "#next_page", function(event){
        event.preventDefault();
        
        sendLink($('#next_page_value').val());
    });
    
    $(document).on("click", "#units_list button", function(){        
        if ($(this).hasClass('opener')) {
            var html_id= $(this).attr('id');
            var html_id_split= html_id.split('_');
            var id= html_id_split[1];
            var action= html_id_split[0];
            
            $(this).addClass('hidden');
        
            if(action == 'show'){
                $('#hide_'+id).removeClass('hidden');
                $('#detail_'+id).height(0);
                $('#detail_'+id).removeClass('hidden');
                $('#detail_'+id).fadeIn('slow');
            }else{
                $('#show_'+id).removeClass('hidden');
                $('#detail_'+id).fadeOut('slow');
                $('#detail_'+id).addClass('hidden');
            }   
        }else if ($(this).hasClass('map_button')) {
            $('#MapModal #loader').fadeIn('slow');
            $('#MapModal .modal-body div#embedded_content').html('');
            $('#MapModal .modal-body div#embedded_content').html('<object height="400px" width="100%" data="'+dev_stage+'/modal-trial/get-map/'+$(this).attr('value')+'"><param value="aaa.pdf" name="src"/><param value="transparent" name="wmode"/></object>');
            $('#MapModal .modal-body div#embedded_content').fadeIn('slow');
        }
    });
}

function sendLink(link)
{
    if (link != '') {
        $('#units_list').html('');
        $.ajax({
            type:       "POST",
            url:        dev_stage+'/trait/json/find/trait',
            dataType:   "html",
            data:       {'url':link},
            success: function( data ) {
                $('.working').removeClass('working');
                $('#units_list').append(data);
            }
        });     
    }
}


function autocomplateForm()
{    
    $("#TraitSearch_trait").autocomplete({
        search  : function(){$(this).addClass('working'); disableButton('searchTrait_search');},
        open    : function(){$(this).removeClass('working'); enableButton('searchTrait_search');},
        source: function( request, response ) {
            $.ajax({
                url: dev_stage+"/serverconnection/json/find/tag/label/"+request.term,
                dataType: "json",
                success: function( data ) {
                    if(data == ''){
                        //unvalorizeField()
                    }else{
                        response( $.map( data, function( item ) {
                            return {
                                label: item,
                                value: item
                            }
                        }));
                    }
                }
            }).fail(function(){
                $("#TraitSearch_trait").removeClass('working');
                enableButton('searchTrait_search');
            });
        },
        minLength: 1,
        select: function( event, ui ) {
                    if(ui.item)
                        getFieldsForm(ui.item.value);
                },
    });
}

function disableButton(button)
{
    $('#'+button).attr('disabled','disabled');
}

function enableButton(button)
{
    $('#'+button).removeAttr('disabled');
}

function getFieldsForm(value)
{    
    $('#searchTrait_search').addClass('working');
    disableButton('searchTrait_search');
    
    var jsonString = JSON.stringify(value);
    
    $.ajax({
        type: "POST",
        url: dev_stage+"/trait/json/get/tag/fields",
        data: {word : jsonString},
        dataType: "html",
        success: function( data ) {
            $('#searchTrait_search').removeClass('working');
            enableButton('searchTrait_search');
            $('#form_fields_container').append(data);
            $('#form_fields').fadeIn('slow');
        }
    }).fail(function(){
        $('#searchTrait_search').removeClass('working');
        enableButton('searchTrait_search');
    });
}

function enableField(checkbox, field_id)
{
    var $child= $(checkbox).parent().find(':input');
    
    if($(checkbox).is(':checked')){
        $child.each(function(){
            if($(this).attr('id') != $(checkbox).attr('id'))
                $(this).removeAttr('disabled');
        });
    }
    else{
        $child.each(function(){
            if($(this).attr('id') != $(checkbox).attr('id')){
                $(this).val('');
                $(this).attr('disabled','disabled');
            }
        });
    }
}

function deleteFields(button)
{
    $(button).parents('blockquote').remove();

    //console.log($('#form_fields :input').lenght);
    //if($('#form_fields :input').lenght == undefined)
    //    $('#form_fields .form-actions').remove();
}