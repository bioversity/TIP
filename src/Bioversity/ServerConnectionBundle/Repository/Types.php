<?php

namespace Bioversity\ServerConnectionBundle\Repository;

class Types{
	/*=======================================================================================
	 *	PRIMITIVE DATA TYPES																*
	 *======================================================================================*/

	/**
	 * ANY.
	 *
	 * Any.
	 *
	 * This type represents a type wildcard, it qualifies an attribute that can take any type of
	 * value.
	 *
	 * Version 1: (kTYPE_ANY)[:ANY]
	 */
	const kTYPE_ANY	=								':ANY';

	/**
	 * STRING.
	 *
	 * String.
	 *
	 * This type defines a string or short text that is generally used for names.
	 *
	 * Version 1: (kTYPE_STRING)[:STRING]
	 */
	const kTYPE_STRING =   							':STRING';

	/**
	 * TEXT.
	 *
	 * Text.
	 *
	 * This type defines a string or long text that is generally used for descriptions.
	 *
	 * Version 1: (kTYPE_TEXT)[:TEXT]
	 */
	const kTYPE_TEXT =   							':TEXT';

	/**
	 * INT.
	 *
	 * Integer number.
	 *
	 * This type defines an integer signed number, this number does not have a decimal part and
	 * has an indeterminate precision.
	 *
	 * Version 1: (kTYPE_INT)[:INT]
	 */
	const kTYPE_INT =   							':INT';

	/**
	 * FLOAT.
	 *
	 * Floating point number.
	 *
	 * This type defines a signed floating point numeric value of indeterminate precision.
	 *
	 * Version 1: (kTYPE_FLOAT)[:FLOAT]
	 */
	const kTYPE_FLOAT =   							':FLOAT';

	/**
	 * BOOLEAN.
	 *
	 * Boolean switch.
	 *
	 * This type defines a switch that can take two values: ON and OFF. By default we assume it
	 * to to be represented by a number in which zero is OFF and any other value is ON. Other
	 * representations are yes/no, true/false.
	 *
	 * Version 1: (kTYPE_BOOLEAN)[:BOOLEAN]
	 */
	const kTYPE_BOOLEAN =   						':BOOLEAN';

	/*=======================================================================================
	 *	CUSTOM PRIMITIVE DATA TYPES															*
	 *======================================================================================*/

	/**
	 * BINARY.
	 *
	 * Binary string.
	 *
	 * This type represents a sequence of bytes. It is equivalent to the {@link kTYPE_STRING}
	 * type, except that the string can hold elements of any value, while the
	 * {@link kTYPE_STRING} type holds only text elements.
	 *
	 * Version 1: (kTYPE_BINARY)[:BINARY]
	 */
	const kTYPE_BINARY_STRING =   					':BINARY';

	/**
	 * DATE.
	 *
	 * Date string.
	 *
	 * This type represents a date in the form of a <tt>YYYYMMDD</tt> string in which missing
	 * elements should be omitted. This means that if we don't know the day we can express that
	 * date as <tt>YYYYMM</tt> and if we don't know the month we can express it as
	 * <tt>YYYY</tt>.
	 *
	 * This type is functionally identical to a {@link kTYPE_STRING} type, except that its
	 * elements can only be digits and their structure is known.
	 *
	 * Version 1: (kTYPE_DATE)[:DATE-STRING']
	 */
	const kTYPE_DATE_STRING =   					':DATE';

	/**
	 * TIME.
	 *
	 * Time string.
	 *
	 * This type is a combination of the {@link kTYPE_DATE_STRING} type followed by a structure
	 * of three elements representing the hours, minutes and seconds, <tt>YYYYMMDD HHMMSS</tt>.
	 * Missing elements are omitted, this means that if you don't have the minutes you would
	 * have a <tt>YYYYMMDD HH</tt> and if you don't have the time it would become and act as a
	 * {@link kTYPE_DATE_STRING} type.
	 *
	 * This type is functionally identical to a {@link kTYPE_STRING} type, except that its
	 * elements can only be digits and their structure is known.
	 *
	 * Version 1: (kTYPE_TIME)[:DATE-STRING']
	 */
	const kTYPE_TIME_STRING =   					':TIME';

	/**
	 * REGEX.
	 *
	 * Regular expression.
	 *
	 * This type represents a regular expression string, it is used to perform complex pattern
	 * selections in strings.
	 *
	 * Version 1: (kTYPE_REGEX)[:REGEX']
	 */
	const kTYPE_REGEX_STRING =   					':REGEX';

	/**
	 * URL.
	 *
	 * Uniform Resource Locator.
	 *
	 * This type represents a web address or link, it is used to indicate the source or location
	 * of a resource.
	 *
	 * Version 1: (kTYPE_URL_STRING)[:URL]
	 */
	const kTYPE_URL_STRING =   						':URL';

	/**
	 * 32.
	 *
	 * 32 bit integer.
	 *
	 * This type defines a 32 bit signed integer, this number ranges from −2,147,483,648 to
	 * 2,147,483,647.
	 *
	 * Version 1: (kTYPE_INT32)[:INT32]
	 */
	const kTYPE_INT32 =   							':INT32';

	/**
	 * 64.
	 *
	 * 64 bit integer.
	 *
	 * This type defines a 64 bit signed integer, this number ranges from
	 * −9,223,372,036,854,775,808 to 9,223,372,036,854,775,807.
	 *
	 * Version 1: (kTYPE_INT64)[:INT64]
	 */
	const kTYPE_INT64 =   							':INT64';

	/*=======================================================================================
	 *	OBJECT REFERENCE DATA TYPES															*
	 *======================================================================================*/

	/**
	 * REF-TERM.
	 *
	 * Term reference.
	 *
	 * This type represents the reference to a term object, term identifiers are by definition
	 * binary strings, {@link kTYPE_BINARY_STRING}.
	 *
	 * Version 1: (kTYPE_REF_TERM)[:REF-TERM]
	 */
	const kTYPE_REF_TERM =   						':REF-TERM';

	/**
	 * REF-NODE.
	 *
	 * Node reference.
	 *
	 * This type represents the reference to a node object, node identifiers are by definition
	 * integers, {@link kTYPE_INT}.
	 *
	 * Version 1: (kTYPE_REF_NODE)[:REF-NODE]
	 */
	const kTYPE_REF_NODE =   						':REF-NODE';

	/**
	 * REF-EDGE.
	 *
	 * Edge reference.
	 *
	 * This type represents the reference to an edge object, edge identifiers are by definition
	 * integers, {@link kTYPE_INT}.
	 *
	 * Version 1: (kTYPE_REF_EDGE)[:REF-EDGE]
	 */
	const kTYPE_REF_EDGE =   						':REF-EDGE';

	/**
	 * REF-TAG.
	 *
	 * Tag reference.
	 *
	 * This type represents the reference to a tag object, tag identifiers are by definition
	 * integers, {@link kTYPE_INT}.
	 *
	 * Version 1: (kTYPE_REF_TAG)[:REF-TAG]
	 */
	const kTYPE_REF_TAG =   						':REF-TAG';

	/**
	 * REF-UNIT.
	 *
	 * Unit reference.
	 *
	 * This type represents the reference to a unit object, unit identifiers are by definition
	 * binary strings, {@link kTYPE_BINARY_STRING}.
	 *
	 * Version 1: (kTYPE_REF_UNIT)[:REF-UNIT]
	 */
	const kTYPE_REF_UNIT =   						':REF-UNIT';

	/**
	 * REF-ENTITY.
	 *
	 * Entity reference.
	 *
	 * This type represents the reference to an entity object, entity identifiers are by
	 * definition strings, {@link kTYPE_STRING}.
	 *
	 * Version 1: (kTYPE_REF_ENTITY)[:REF-ENTITY]
	 */
	const kTYPE_REF_ENTITY =   						':REF-ENTITY';

	/*=======================================================================================
	 *	STANDARD FORMAT TYPES																*
	 *======================================================================================*/

	/**
	 * META.
	 *
	 * Metadata.
	 *
	 * This type represents the primitive meta data type, it is a generalised metadata type.
	 *
	 * Version 1: (kTYPE_META)[:META]
	 */
	const kTYPE_META =   							':META';

	/**
	 * PHP.
	 *
	 * PHP.
	 *
	 * This type represents the <tt>PHP</tt> serialised data format.
	 *
	 * This type is functionally identical to a {@link kTYPE_STRING} type, except that the
	 * contents are encoded.
	 *
	 * Version 1: (kTYPE_PHP)[:PHP]
	 */
	const kTYPE_PHP =   							':PHP';

	/**
	 * JSON.
	 *
	 * JSON.
	 *
	 * This type represents the <tt>JSON</tt> encoded data format.
	 *
	 * This type is functionally identical to a {@link kTYPE_STRING} type, except that the
	 * contents are encoded.
	 *
	 * Version 1: (kTYPE_JSON)[:JSON]
	 */
	const kTYPE_JSON =   							':JSON';

	/**
	 * XML.
	 *
	 * XML.
	 *
	 * This type represents the <tt>XML</tt> encoded data format.
	 *
	 * This type is functionally identical to a {@link kTYPE_STRING} type, except that the
	 * contents are encoded.
	 *
	 * Version 1: (kTYPE_XML)[:XML]
	 */
	const kTYPE_XML =   							':XML';

	/**
	 * SVG.
	 *
	 * SVG.
	 *
	 * This type represents the <tt>SVG</tt> encoded data format.
	 *
	 * This type is functionally identical to a {@link kTYPE_XML} type, except that the contents
	 * represent an image file.
	 *
	 * Version 1: (kTYPE_SVG)[:SVG]
	 */
	const kTYPE_SVG =   							':SVG';

	/*=======================================================================================
	 *	STRUCTURED DATA TYPES																*
	 *======================================================================================*/

	/**
	 * STRUCT.
	 *
	 * Structure.
	 *
	 * This data type refers to a structure, it implies that the offset to which it refers to
	 * is a container of other offsets that will hold the actual data.
	 *
	 * This type, when passed to a tag, indicates that the tag cannot refer to data, but that it
	 * defines a container for data elements.
	 *
	 * Version 1: (kTYPE_STRUCT)[:STRUCT]
	 */
	const kTYPE_STRUCT =   							':STRUCT';

	/**
	 * LSTRING.
	 *
	 * Language string.
	 *
	 * This type represents a {@link kTYPE_STRING} attribute that can be expressed in several
	 * languages, it is implemented as an array of elements in which the index represents the
	 * language code in which the string is expressed and the value is the string.
	 *
	 * Version 1: (kTYPE_LSTRING)[:LSTRING]
	 */
	const kTYPE_LSTRING =   						':LSTRING';

	/**
	 * LTEXT.
	 *
	 * Language text.
	 *
	 * This type represents a {@link kTYPE_TEXT} attribute that can be expressed in several
	 * languages, it is implemented as an array of elements in which the index represents the
	 * language code in which the text is expressed and the value is the text.
	 *
	 * Version 1: (kTYPE_LTEXT)[:LTEXT]
	 */
	const kTYPE_LTEXT =   							':LTEXT';

	/**
	 * STAMP.
	 *
	 * Time-stamp.
	 *
	 * This type represents a native time-stamp data type, it holds the date, time and
	 * milliseconds.
	 *
	 * Version 1: (kTYPE_STAMP)[:TIME-STAMP]
	 */
	const kTYPE_STAMP =   							':STAMP';

	/**
	 * TYPED-LIST.
	 *
	 * Typed list.
	 *
	 * This type represents a list of items, each having two components: a type and the data.
	 *
	 * The structure is an array of two elements:
	 *
	 * <ul>
	 *	<li><tt>{@link kTAG_TYPED_TYPE}</tt>: The element type; in general this value should be
	 *		taken from an enumerated set. This element is optional.
	 *	<li><tt>{@link kTAG_TYPED_DATA}</tt>: The element data.
	 * </ul>
	 *
	 * Version 1: (kTYPE_TYPED_LIST)[:TYPED-LIST]
	 */
	const kTYPE_TYPED_LIST =   						':TYPED-LIST';

	/**
	 * RANGE.
	 *
	 * Range.
	 *
	 * This type represents a value or a range of values, it is an array containing the
	 * following elements:
	 *
	 * <ul>
	 *	<li><tt>{@link kTAG_RANGE_MIN}</tt>: Minimum value.
	 *	<li><tt>{@link kTAG_RANGE_MEAN}</tt>: Mean value.
	 *	<li><tt>{@link kTAG_RANGE_MAX}</tt>: Maximum value.
	 * </ul>
	 *
	 * This type can be used in the following ways:
	 *
	 * <ul>
	 *	<li><tt>{@link kTAG_RANGE_MEAN}</tt> value only: In this case the attribute holds only
	 *		the mean or exact value of the measurement.
	 *	<li><tt>{@link kTAG_RANGE_MIN}</tt> and <tt>{@link kTAG_RANGE_MAX}</tt> value only: In
	 *		this case the attribute represents the minimum and maximum values.
	 *	<li><tt>{@link kTAG_RANGE_MIN}</tt>, <tt>{@link kTAG_RANGE_MEAN}</tt> and
	 *		<tt>{@link kTAG_RANGE_MAX}</tt>: In this case the attribute represents the minimum
	 *		and maximum values, including the mean value.
	 * </ul>
	 *
	 * Version 1: (kTYPE_RANGE)[:RANGE]
	 */
	const kTYPE_RANGE =   							':RANGE';

	/**
	 * SHAPE.
	 *
	 * Shape.
	 *
	 * This type represents a native shape data type, it is a structure that can be used to
	 * record geometrical shapes.
	 *
	 * The structure is an array of two elements:
	 *
	 * <ul>
	 *	<li><tt>{@link kTAG_CUSTOM_TYPE}</tt>: The shape type:
	 *	 <ul>
	 *		<li><tt>Point</tt>: A point.
	 *		<li><tt>LineString</tt>: A line segment.
	 *		<li><tt>Polygon</tt>: A polygon.
	 *	 </ul>
	 *	<li><tt>{@link kTAG_CUSTOM_COORDINATES}</tt>: An array of elements:
	 *	 <ul>
	 *		<li><tt>Point</tt>: The longitude and the latitude.
	 *		<li><tt>LineString</tt>: An array of two points, expressed as longitude and latitude,
	 *			representing the start and end of the line segment.
	 *		<li><tt>Polygon</tt>: An array of longitude and latitude points representing the
	 *			vertices of the polygon, with the first and last being the same point.
	 *	 </ul>
	 * </ul>
	 *
	 * Version 1: (kTYPE_SHAPE)[:SHAPE]
	 */
	const kTYPE_SHAPE =   							':SHAPE';

	/*=======================================================================================
	 *	ENUMERATED TYPES																	*
	 *======================================================================================*/

	/**
	 * ENUM.
	 *
	 * Enumeration.
	 *
	 * This value represents the enumeration data type, it represents an enumeration element or
	 * container.
	 *
	 * Enumerations represent a vocabulary from which one value must be chosen, this particular
	 * data type is used in {@link COntologyNode} objects: it indicates that the node refers to
	 * a controlled vocabulary scalar data type and that the enumerated set follows in the graph
	 * definition.
	 *
	 * Version 1: (kTYPE_ENUM)[:ENUM]
	 */
	const kTYPE_ENUM =   							':ENUM';

	/**
	 * SET.
	 *
	 * Enumerated set.
	 *
	 * This value represents the enumerated set data type, it represents an enumerated set
	 * element or container.
	 *
	 * Sets represent a vocabulary from which one or more value must be chosen, this particular
	 * data type is used in {@link COntologyNode} objects: it indicates that the node refers to
	 * a controlled vocabulary array data type and that the enumerated set follows in the graph
	 * definition.
	 *
	 * Version 1: (kTYPE_ENUM_SET)[:SET]
	 */
	const kTYPE_ENUM_SET =   						':SET';

	/*=======================================================================================
	 *	SHAPE TYPES																			*
	 *======================================================================================*/

	/**
	 * SHAPE-POINT.
	 *
	 * Point shape.
	 *
	 * This type indicates a shape that represents a point.
	 *
	 * Version 1: (kTYPE_SHAPE_POINT)[:SHAPE:POINT]
	 */
	const kTYPE_SHAPE_POINT =   					':SHAPE:POINT';

	/**
	 * SHAPE-LINE-STRING.
	 *
	 * LineString shape.
	 *
	 * This type indicates a shape that represents a line string, or a set of connected lines.
	 *
	 * Version 1: (kTYPE_SHAPE_LINE_STRING)[:SHAPE:LINE-STRING]
	 */
	const kTYPE_SHAPE_LINE_STRING =   				':SHAPE:LINE-STRING';

	/**
	 * SHAPE-POLYGON.
	 *
	 * Polygon shape.
	 *
	 * This type indicates a shape that represents a polygon in which the first and last
	 * vertices must be the same point.
	 *
	 * Version 1: (kTYPE_SHAPE_POLYGON)[:SHAPE:POLYGON]
	 */
	const kTYPE_SHAPE_POLYGON =   					':SHAPE:POLYGON';

	/*=======================================================================================
	 *	MONGO TYPES																			*
	 *======================================================================================*/

	/**
	 * MongoId.
	 *
	 * This type represents the <tt>MongoId</tt> data type, when serialised it will be encoded
	 * into the following structure:
	 * <ul>
	 *	<li><tt>{@link kTAG_CUSTOM_TYPE}</tt>: Will contain this constant.
	 *	<li><tt>{@link kTAG_CUSTOM_DATA}</tt>: Will contain the HEX string ID.
	 * </ul>
	 *
	 * Version 1: (kTYPE_MongoId)[:MongoId]
	 */
	const kTYPE_MongoId =   						':MongoId';

	/**
	 * MongoCode.
	 *
	 * This type represents the <tt>MongoCode</tt> data type, when serialised it will be encoded
	 * into the following structure:
	 * <ul>
	 *	<li><tt>code</tt>: The javascript code string.
	 *	<li><tt>scope</tt>: The list of key/value pairs.
	 * </ul>
	 *
	 * Version 1: (kTYPE_MongoCode)[:MongoCode]
	 */
	const kTYPE_MongoCode =   						':MongoCode';

	/*=======================================================================================
	 *	RELATIONSHIP TYPES																	*
	 *======================================================================================*/

	/**
	 * RELATION-IN.
	 *
	 * Incoming relationship.
	 *
	 * This type indicates an incoming relationship, in other words, all the relationships that
	 * point to the current object.
	 *
	 * Version 1: (kTYPE_RELATION_IN)[:RELATION-IN]
	 */
	const kTYPE_RELATION_IN =   					':RELATION-IN';

	/**
	 * OUTGOING.
	 *
	 * Outgoing relationship.
	 *
	 * This type indicates an outgoing relationship, in other words, all the relationships that
	 * originate from the current object.
	 *
	 * Version 1: (kTYPE_RELATION_OUT)[:RELATION-OUT]
	 */
	const kTYPE_RELATION_OUT =   					':RELATION-OUT';

	/**
	 * ALL.
	 *
	 * All relationships.
	 *
	 * This type indicates all relationships, both incoming and outgoing.
	 *
	 * Version 1: (kTYPE_RELATION_ALL)[:RELATION-ALL]
	 */
	const kTYPE_RELATION_ALL =   					':RELATION-ALL';

	/*=======================================================================================
	 *	CARDINALITY TYPES																	*
	 *======================================================================================*/

	/**
	 * REQUIRED.
	 *
	 * Required.
	 *
	 * This type indicates that the element is required, which means that it must be present in
	 * the object.
	 *
	 * If this type is missing, it means that the element is optional.
	 *
	 * Version 1: (kTYPE_CARD_REQUIRED)[:REQUIRED]
	 */
	const kTYPE_REQUIRED =   						':REQUIRED';

	/**
	 * RESTRICTED.
	 *
	 * Restricted.
	 *
	 * This type applies mostly to enumerated sets, it indicates that the attribute is
	 * restricted to an enumerated set.
	 *
	 * If this type is missing, it means that the attribute may take values not belonging to the
	 * enumerated set.
	 *
	 * Version 1: (kTYPE_CARD_RESTRICTED)[:RESTRICTED]
	 */
	const kTYPE_RESTRICTED =   						':RESTRICTED';

	/**
	 * COMPUTED.
	 *
	 * Computed.
	 *
	 * This type indicates that the element is computed, which means that it is automatically
	 * filled usually when committing the object.
	 *
	 * If this type is missing, it means that the attribute must be explicitly set.
	 *
	 * Version 1: (kTYPE_COMPUTED)[:COMPUTED]
	 */
	const kTYPE_COMPUTED =   						':COMPUTED';

	/**
	 * LOCKED.
	 *
	 * Locked.
	 *
	 * This type indicates that the element is locked, which means that it is not modifiable.
	 * This means that the value cannot be changed once the object has been committed.
	 *
	 * If this type is missing, it means that the attribute can be explicitly modified.
	 *
	 * Version 1: (kTYPE_LOCKED)[:LOCKED]
	 */
	const kTYPE_LOCKED =   							':LOCKED';

	/**
	 * HIDDEN.
	 *
	 * Hidden.
	 *
	 * This type indicates that the element is hidden, which means that it should not be
	 * displayed.
	 *
	 * If this type is missing, it means that the attribute can be displayed.
	 *
	 * Version 1: (kTYPE_HIDDEN)[:HIDDEN]
	 */
	const kTYPE_HIDDEN =   							':HIDDEN';

	/**
	 * INDEXED.
	 *
	 * Indexed.
	 *
	 * This type indicates that the element is indexed.
	 *
	 * If this type is missing, it means that it is not indexed.
	 *
	 * Version 1: (kTYPE_INDEXED)[:INDEXED]
	 */
	const kTYPE_INDEXED =   						':INDEXED';

	/**
	 * UNIQUE.
	 *
	 * Unique.
	 *
	 * This type indicates that the element is unique. This does not means necessarily that the
	 * item is {@link kTYPE_INDEXED}, it only means that there cannot be two elements in the
	 * same container that share the same value.
	 *
	 * If this type is missing, it means that it is not unique.
	 *
	 * Version 1: (kTYPE_INDEXED)[:INDEXED]
	 */
	const kTYPE_UNIQUE =   							':UNIQUE';

	/**
	 * ARRAY.
	 *
	 * Array.
	 *
	 * This type indicates that the attribute is a list of values, which means that the
	 * attribute is an array of elements of the provided data type.
	 *
	 * If this type is missing, it means that it is a scalar element.
	 *
	 * Version 1: (kTYPE_CARD_ARRAY)[:ARRAY]
	 */
	const kTYPE_ARRAY =   							':ARRAY';

}