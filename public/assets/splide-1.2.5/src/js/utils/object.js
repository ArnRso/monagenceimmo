/**
 * Some utility functions related with Object, supporting IE.
 *
 * @author    Naotoshi Fujita
 * @copyright Naotoshi Fujita. All rights reserved.
 */

/**
 * Iterate an object like Array.forEach.
 * IE doesn't support forEach of HTMLCollection.
 *
 * @param {Object}    obj       - An object.
 * @param {function}  callback  - A function handling each value. Arguments are value, property and index.
 */
export function each( obj, callback ) {
	Object.keys( obj ).some( ( key, index ) => {
		return callback( obj[ key ], key, index );
	} );
}

/**
 * Return values of the given object as an array.
 * IE doesn't support Object.values.
 *
 * @param {Object} obj - An object.
 *
 * @return {Array} - An array containing all values of the given object.
 */
export function values( obj ) {
	return Object.keys( obj ).map( key => obj[ key ] );
}

/**
 * Check if the given subject is object or not.
 *
 * @param {*} subject - A subject to be verified.
 *
 * @return {boolean} - True if object, false otherwise.
 */
export function isObject( subject ) {
	return typeof subject === 'object';
}

/**
 * Merge two objects deeply.
 *
 * @param {Object} to   - An object where "from" is merged.
 * @param {Object} from - An object merged to "to".
 *
 * @return {Object} - A merged object.
 */
export function merge( { ...to }, from ) {
	if ( isObject( to ) && isObject( from ) ) {
		each( from, ( value, key ) => {
			if ( isObject( value ) ) {
				if ( ! isObject( to[ key ] ) ) {
					to[ key ] = {};
				}

				to[ key ] = merge( to[ key ], value );
			} else {
				to[ key ] = value;
			}
		} );
	}

	return to;
}