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
 * CROSSABILITY.
 *
 * Crossability.
 */
var kTAG_CROSS = '56';

/**
 * LOCATION.
 *
 * Location attributes.
 */
var kTAG_LOCATION = '57';

/**
 * ENVIRONMENT.
 *
 * Environment attributes.
 */
var kTAG_ENVIRONMENT = '58';

/**
 * BIOCLIMATIC.
 *
 * Bio-climatic attributes.
 */
var kTAG_BIOCLIMATIC = '59';

/**
 * TEMPERATURE.
 *
 * Monthly temperature attributes.
 */
var kTAG_TEMPERATURE = '60';

/**
 * PRECIPITATION.
 *
 * Monthly precipitation attributes.
 */
var kTAG_PRECIPITATION = '61';

/*=======================================================================================
 *	INVENTORY ATTRIBUTES																*
 *======================================================================================*/

/**
 * NICODE.
 *
 * National inventory.
 */
var kTAG_NICODE = '62';

/**
 * FAO:INSTCODE.
 *
 * Responsible institution.
 */
var kTAG_INSTCODE = '63';

/*=======================================================================================
 *	STATUS ATTRIBUTES																	*
 *======================================================================================*/

/**
 * AVAILABLE.
 *
 * Available.
 */
var kTAG_AVAILABLE = '64';

/**
 * RESTRICTIONS.
 *
 * Restrictions.
 */
var kTAG_RESTRICTIONS = '65';

/*=======================================================================================
 *	TAXON ATTRIBUTES																	*
 *======================================================================================*/

/**
 * TAXON-NAME.
 *
 * Taxon name.
 */
var kTAG_TAXON_NAME = '66';

/**
 * TAXON-GENERA.
 *
 * Taxon genera.
 */
var kTAG_TAXON_GENERA = '67';

/**
 * TAXON-RANK.
 *
 * Taxon rank.
 */
var kTAG_TAXON_RANK = '68';

/**
 * CROP.
 *
 * Taxon crop.
 */
var kTAG_CROP = '69';

/**
 * ANNEX1.
 *
 * Taxon name.
 */
var kTAG_ANNEX1 = '70';

/*=======================================================================================
 *	CROSSABILITY ATTRIBUTES																*
 *======================================================================================*/

/**
 * LISTSPCROSS.
 *
 * List of species crosses.
 */
var kTAG_LISTSPCROSS = '71';

/**
 * LISTSPCROSSREF.
 *
 * List of species crosses references.
 */
var kTAG_LISTSPCROSSREF = '72';

/**
 * METHCROSSREF.
 *
 * Method used for crosses.
 */
var kTAG_METHCROSSREF = '73';

/**
 * SUCCROSSREF.
 *
 * Success rate of crosses.
 */
var kTAG_SUCCROSSREF = '74';

/*=======================================================================================
 *	LOCATION ATTRIBUTES																	*
 *======================================================================================*/

/**
 * COORDINATES.
 *
 * Location coordinates.
 */
var kTAG_COORDINATES = '75';

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
var kTAG_LATITUDE_DISPLAY = '76';

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
var kTAG_LONGITUDE_DISPLAY = '77';

/*=======================================================================================
 *	ENVIRONMENT ATTRIBUTES																*
 *======================================================================================*/

/**
 * GENS.
 *
 * Global Environment Stratification.
 */
var kTAG_GENS = '78';

/**
 * GENS-CLIM.
 *
 * Climatic Zone.
 */
var kTAG_GENS_CLIM = '79';

/**
 * GENS-ENV.
 *
 * Environmental Zone.
 */
var kTAG_GENS_ENV = '80';

/**
 * CLIM-ELEV-MIN.
 *
 * Minimum environment elevation.
 *
 * This attribute records the minimum elevation of the climatic area, that is, the minimum
 * elevation found when retrieving climatic data.
 */
var kTAG_CLIM_ELEV_MIN = '81';

/**
 * CLIM-ELEV-MEAN.
 *
 * Mean environment elevation.
 *
 * This attribute records the mean elevation of the climatic area, that is, the mean
 * elevation found when retrieving climatic data.
 */
var kTAG_CLIM_ELEV_MEAN = '82';

/**
 * CLIM-ELEV-MAX.
 *
 * Maximum environment elevation.
 *
 * This attribute records the maximum elevation of the climatic area, that is, the maximum
 * elevation found when retrieving climatic data.
 */
var kTAG_CLIM_ELEV_MAX = '83';

/**
 * CLIM-DIST-MIN.
 *
 * Minimum environment distance.
 *
 * This attribute records the minimum distance of the climatic area from the provided
 * geometry.
 */
var kTAG_CLIM_DIST_MIN = '84';

/**
 * CLIM-DIST-MEAN.
 *
 * Mean environment distance.
 *
 * This attribute records the mean distance of the climatic area from the provided
 * geometry.
 */
var kTAG_CLIM_DIST_MEAN = '85';

/**
 * CLIM-DIST-MAX.
 *
 * Maximum environment distance.
 *
 * This attribute records the maximum distance of the climatic area from the provided
 * geometry.
 */
var kTAG_CLIM_DIST_MAX = '86';

/*=======================================================================================
 *	BIO-CLIMATIC ATTRIBUTES																*
 *======================================================================================*/

/**
 * BIO1.
 *
 * Annual Mean Temperature.
 */
var kTAG_BIO1 = '87';

/**
 * BIO2.
 *
 * Mean Diurnal Range.
 */
var kTAG_BIO2 = '88';

/**
 * BIO3.
 *
 * Isothermality.
 */
var kTAG_BIO3 = '89';

/**
 * BIO4.
 *
 * Temperature Seasonality.
 */
var kTAG_BIO4 = '90';

/**
 * BIO5.
 *
 * Maximum Temperature of Warmest Month.
 */
var kTAG_BIO5 = '91';

/**
 * BIO6.
 *
 * Minimum Temperature of Coldest Month.
 */
var kTAG_BIO6 = '92';

/**
 * BIO7.
 *
 * Temperature Annual Range.
 */
var kTAG_BIO7 = '93';

/**
 * BIO8.
 *
 * Mean Temperature of Wettest Quarter.
 */
var kTAG_BIO8 = '94';

/**
 * BIO9.
 *
 * Mean Temperature of Driest Quarter.
 */
var kTAG_BIO9 = '95';

/**
 * BIO10.
 *
 * Mean Temperature of Warmest Quarter.
 */
var kTAG_BIO10 = '96';

/**
 * BIO11.
 *
 * Mean Temperature of Coldest Quarter.
 */
var kTAG_BIO11 = '97';

/**
 * BIO12.
 *
 * Annual Precipitation.
 */
var kTAG_BIO12 = '98';

/**
 * BIO13.
 *
 * Precipitation of Wettest Month.
 */
var kTAG_BIO13 = '99';

/**
 * BIO14.
 *
 * Precipitation of Driest Month.
 */
var kTAG_BIO14 = '199';

/**
 * BIO15.
 *
 * Precipitation Seasonality.
 */
var kTAG_BIO15 = '101';

/**
 * BIO16.
 *
 * Precipitation of Wettest Quarter.
 */
var kTAG_BIO16 = '102';

/**
 * BIO17.
 *
 * Precipitation of Driest Quarter.
 */
var kTAG_BIO17 = '103';

/**
 * BIO18.
 *
 * Precipitation of Warmest Quarter.
 */
var kTAG_BIO18 = '104';

/**
 * BIO19.
 *
 * Precipitation of Coldest Quarter.
 */
var kTAG_BIO19 = '105';

/*=======================================================================================
 *	MONTHLY TEMPERATURE ATTRIBUTES														*
 *======================================================================================*/

/**
 * TEMP1.
 *
 * January mean temperature.
 */
var kTAG_TEMP1 = '106';

/**
 * TEMP1-MIN.
 *
 * January minimum temperature.
 */
var kTAG_TEMP1_MIN = '107';

/**
 * TEMP1-MAX.
 *
 * January maximum temperature.
 */
var kTAG_TEMP1_MAX = '108';

/**
 * TEMP2.
 *
 * February mean temperature.
 */
var kTAG_TEMP2 = '109';

/**
 * TEMP2-MIN.
 *
 * February minimum temperature.
 */
var kTAG_TEMP2_MIN = '110';

/**
 * TEMP2-MAX.
 *
 * February maximum temperature.
 */
var kTAG_TEMP2_MAX = '111';

/**
 * TEMP3.
 *
 * March mean temperature.
 */
var kTAG_TEMP3 = '112';

/**
 * TEMP3-MIN.
 *
 * March minimum temperature.
 */
var kTAG_TEMP3_MIN = '113';

/**
 * TEMP3-MAX.
 *
 * March maximum temperature.
 */
var kTAG_TEMP3_MAX = '114';

/**
 * TEMP4.
 *
 * April mean temperature.
 */
var kTAG_TEMP4 = '115';

/**
 * TEMP4-MIN.
 *
 * April minimum temperature.
 */
var kTAG_TEMP4_MIN = '116';

/**
 * TEMP4-MAX.
 *
 * April maximum temperature.
 */
var kTAG_TEMP4_MAX = '117';

/**
 * TEMP5.
 *
 * May mean temperature.
 */
var kTAG_TEMP5 = '118';

/**
 * TEMP5-MIN.
 *
 * May minimum temperature.
 */
var kTAG_TEMP5_MIN = '119';

/**
 * TEMP5-MAX.
 *
 * May maximum temperature.
 */
var kTAG_TEMP5_MAX = '120';

/**
 * TEMP6.
 *
 * June mean temperature.
 */
var kTAG_TEMP6 = '121';

/**
 * TEMP6-MIN.
 *
 * June minimum temperature.
 */
var kTAG_TEMP6_MIN = '122';

/**
 * TEMP6-MAX.
 *
 * June maximum temperature.
 */
var kTAG_TEMP6_MAX = '123';

/**
 * TEMP7.
 *
 * July mean temperature.
 */
var kTAG_TEMP7 = '124';

/**
 * TEMP7-MIN.
 *
 * July minimum temperature.
 */
var kTAG_TEMP7_MIN = '125';

/**
 * TEMP7-MAX.
 *
 * July maximum temperature.
 */
var kTAG_TEMP7_MAX = '126';

/**
 * TEMP8.
 *
 * August mean temperature.
 */
var kTAG_TEMP8 = '127';

/**
 * TEMP8-MIN.
 *
 * August minimum temperature.
 */
var kTAG_TEMP8_MIN = '128';

/**
 * TEMP8-MAX.
 *
 * August maximum temperature.
 */
var kTAG_TEMP8_MAX = '129';

/**
 * TEMP9.
 *
 * September mean temperature.
 */
var kTAG_TEMP9 = '130';

/**
 * TEMP9-MIN.
 *
 * September minimum temperature.
 */
var kTAG_TEMP9_MIN = '131';

/**
 * TEMP9-MAX.
 *
 * September maximum temperature.
 */
var kTAG_TEMP9_MAX = '132';

/**
 * TEMP10.
 *
 * October mean temperature.
 */
var kTAG_TEMP10 = '133';

/**
 * TEMP10-MIN.
 *
 * October minimum temperature.
 */
var kTAG_TEMP10_MIN = '134';

/**
 * TEMP10-MAX.
 *
 * October maximum temperature.
 */
var kTAG_TEMP10_MAX = '135';

/**
 * TEMP11.
 *
 * November mean temperature.
 */
var kTAG_TEMP11 = '136';

/**
 * TEMP11-MIN.
 *
 * November minimum temperature.
 */
var kTAG_TEMP11_MIN = '137';

/**
 * TEMP11-MAX.
 *
 * November maximum temperature.
 */
var kTAG_TEMP11_MAX = '138';

/**
 * TEMP12.
 *
 * December mean temperature.
 */
var kTAG_TEMP12 = '139';

/**
 * TEMP12-MIN.
 *
 * December minimum temperature.
 */
var kTAG_TEMP12_MIN = '140';

/**
 * TEMP12-MAX.
 *
 * December maximum temperature.
 */
var kTAG_TEMP12_MAX = '141';

/*=======================================================================================
 *	MONTHLY PRECIPITATION ATTRIBUTES													*
 *======================================================================================*/

/**
 * PREC1.
 *
 * January mean precipitation (mm.).
 */
var kTAG_PREC1 = '142';

/**
 * PREC1-MIN.
 *
 * January minimum precipitation (mm.).
 */
var kTAG_PREC1_MIN = '143';

/**
 * PREC1-MAX.
 *
 * January maximum precipitation (mm.).
 */
var kTAG_PREC1_MAX = '144';

/**
 * PREC2.
 *
 * February mean precipitation (mm.).
 */
var kTAG_PREC2 = '145';

/**
 * PREC2-MIN.
 *
 * February minimum precipitation (mm.).
 */
var kTAG_PREC2_MIN = '146';

/**
 * PREC2-MAX.
 *
 * February maximum precipitation (mm.).
 */
var kTAG_PREC2_MAX = '147';

/**
 * PREC3.
 *
 * March mean precipitation (mm.).
 */
var kTAG_PREC3 = '148';

/**
 * PREC3-MIN.
 *
 * March minimum precipitation (mm.).
 */
var kTAG_PREC3_MIN = '149';

/**
 * PREC3-MAX.
 *
 * March maximum precipitation (mm.).
 */
var kTAG_PREC3_MAX = '150';

/**
 * PREC4.
 *
 * April mean precipitation (mm.).
 */
var kTAG_PREC4 = '151';

/**
 * PREC4-MIN.
 *
 * April minimum precipitation (mm.).
 */
var kTAG_PREC4_MIN = '152';

/**
 * PREC4-MAX.
 *
 * April maximum precipitation (mm.).
 */
var kTAG_PREC4_MAX = '153';

/**
 * PREC5.
 *
 * May mean precipitation (mm.).
 */
var kTAG_PREC5 = '154';

/**
 * PREC5-MIN.
 *
 * May minimum precipitation (mm.).
 */
var kTAG_PREC5_MIN = '155';

/**
 * PREC5-MAX.
 *
 * May maximum precipitation (mm.).
 */
var kTAG_PREC5_MAX = '156';

/**
 * PREC6.
 *
 * June mean precipitation (mm.).
 */
var kTAG_PREC6 = '157';

/**
 * PREC6-MIN.
 *
 * June minimum precipitation (mm.).
 */
var kTAG_PREC6_MIN = '158';

/**
 * PREC6-MAX.
 *
 * June maximum precipitation (mm.).
 */
var kTAG_PREC6_MAX = '159';

/**
 * PREC7.
 *
 * July mean precipitation (mm.).
 */
var kTAG_PREC7 = '160';

/**
 * PREC7-MIN.
 *
 * July minimum precipitation (mm.).
 */
var kTAG_PREC7_MIN = '161';

/**
 * PREC7-MAX.
 *
 * July maximum precipitation (mm.).
 */
var kTAG_PREC7_MAX = '162';

/**
 * PREC8.
 *
 * August mean precipitation (mm.).
 */
var kTAG_PREC8 = '163';

/**
 * PREC8-MIN.
 *
 * August minimum precipitation (mm.).
 */
var kTAG_PREC8_MIN = '164';

/**
 * PREC8-MAX.
 *
 * August maximum precipitation (mm.).
 */
var kTAG_PREC8_MAX = '165';

/**
 * PREC9.
 *
 * September mean precipitation (mm.).
 */
var kTAG_PREC9 = '166';

/**
 * PREC9-MIN.
 *
 * September minimum precipitation (mm.).
 */
var kTAG_PREC9_MIN = '167';

/**
 * PREC9-MAX.
 *
 * September maximum precipitation (mm.).
 */
var kTAG_PREC9_MAX = '168';

/**
 * PREC10.
 *
 * October mean precipitation (mm.).
 */
var kTAG_PREC10 = '169';

/**
 * PREC10-MIN.
 *
 * October minimum precipitation (mm.).
 */
var kTAG_PREC10_MIN = '170';

/**
 * PREC10-MAX.
 *
 * October maximum precipitation (mm.).
 */
var kTAG_PREC10_MAX = '171';

/**
 * PREC11.
 *
 * November mean precipitation (mm.).
 */
var kTAG_PREC11 = '172';

/**
 * PREC11-MIN.
 *
 * November minimum precipitation (mm.).
 */
var kTAG_PREC11_MIN = '173';

/**
 * PREC11-MAX.
 *
 * November maximum precipitation (mm.).
 */
var kTAG_PREC11_MAX = '174';

/**
 * PREC12.
 *
 * December mean precipitation (mm.).
 */
var kTAG_PREC12 = '175';

/**
 * PREC12-MIN.
 *
 * December minimum precipitation (mm.).
 */
var kTAG_PREC12_MIN = '176';

/**
 * PREC12-MAX.
 *
 * December maximum precipitation (mm.).
 */
var kTAG_PREC12_MAX = '177';

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
var kTAG_FIRST_NAME = '178';

/**
 * LAST-NAME.
 *
 * Entity last name.
 *
 * The entity surname, in case of an individual.
 */
var kTAG_LAST_NAME = '179';

/**
 * MAIL.
 *
 * Entity mail.
 *
 * The mailing address of an entity.
 */
var kTAG_MAIL = '180';

/**
 * EMAIL.
 *
 * Entity e-mail.
 *
 * The e-mail address of an entity.
 */
var kTAG_EMAIL = '181';

/**
 * PHONE.
 *
 * Entity phone.
 *
 * The telephone number of an entity.
 */
var kTAG_PHONE = '182';

/**
 * FAX.
 *
 * Entity fax.
 *
 * The telefax number of an entity.
 */
var kTAG_FAX = '183';

/**
 * WEB-SITE.
 *
 * Entity web site.
 *
 * The entity internet web site address.
 */
var kTAG_WEB_SITE = '184';

/**
 * AFFILIATION.
 *
 * Entity affiliation.
 *
 * The reference to the entity with which the current entity is affiliated.
 */
var kTAG_AFFILIATION = '185';

/**
 * NATIONALITY.
 *
 * Nationality.
 *
 * The country of an entity.
 */
var kTAG_NATIONALITY = '186';

/**
 * ENTITY-KIND.
 *
 * Entity kind.
 *
 * The entity kind.
 */
var kTAG_ENTITY_KIND = '187';

/**
 * ENTITY-TYPE.
 *
 * Entity type.
 *
 * The entity type.
 */
var kTAG_ENTITY_TYPE = '188';

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
var kTAG_USER_CODE = '189';

/**
 * USER-PASS.
 *
 * User password.
 *
 * The password by which a user is known to the system.
 */
var kTAG_USER_PASS = '190';

/**
 * USER-ROLE.
 *
 * User roles.
 *
 * The roles assigned to the user.
 */
var kTAG_USER_ROLE = '191';

/**
 * USER-PROFILE.
 *
 * User profile.
 *
 * The profile role name assigned to the user.
 */
var kTAG_USER_PROFILE = '192';

/**
 * USER-DOMAIN.
 *
 * User domain.
 *
 * List of domains the user has access to.
 */
var kTAG_USER_DOMAIN = '193';

/**
 * USER-SOCIAL-NETWORK.
 *
 * User social network.
 */
var kTAG_USER_SOCIAL_NETWORK = '194';

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
